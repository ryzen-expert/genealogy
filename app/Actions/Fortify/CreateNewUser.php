<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        //        dd($input ,domainFamilies() ,array_keys(domainFamilies()));
        Validator::make($input, [
            'firstname' => ['nullable', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //            'family' => ['required', Rule::in(array_keys(AllFamilies()))],
            'language' => ['required', Rule::in(array_values(config('app.available_locales')))],
            'timezone' => ['required', Rule::in(array_values(timezone_identifiers_list()))],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            $input['family'] = 19;

            return tap(User::create([
                'firstname' => $input['firstname'] ?? null,
                'surname' => $input['surname'],
                'email' => $input['email'],
                'language' => $input['language'],
                'timezone' => $input['timezone'],
                'current_team_id' => $input['family'],
                'password' => Hash::make($input['password']),

            ]), function (User $user) use ($input) {

                $user->current_team_id = $input['family'];
                $team = Team::find($input['family']);
                $user->save();

                $newTeamMember = Jetstream::findUserByEmailOrFail($user->email);

                $team->users()->attach(
                    $newTeamMember, ['role' => 'new_family_member']
                );

                //                $this->createTeam($user);
            });
        });
    }

    /**
     * Set User Family  a personal team for the user.
     */
    protected function createTeam(User $user): void
    {

        //        $user->current_team_id  = Session::get('tree_domain')?->team_id ?? null;
        //        $user->save();
        //        $user->ownedTeams()->save(Team::forceCreate([
        //            'user_id' => $user->id,
        //            'name' => $user->name . "'s Family",
        //            'personal_team' => true,
        //        ]));
    }
}
