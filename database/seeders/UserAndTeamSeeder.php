<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Jetstream;

class UserAndTeamSeeder extends Seeder
{
    public function run()
    {
        // -----------------------------------------------------------------------------------
        // create developer users
        // -----------------------------------------------------------------------------------
        User::factory([
            'firstname' => '_',
            'surname' => 'Developer',
            'email' => 'developer@genealogy.test',
            'is_developer' => true,
        ])
            ->withPersonalTeam()
            ->create();

        User::factory([
            'firstname' => 'Kreaweb',
            'surname' => 'Developer',
            'email' => 'kreaweb@genealogy.test',
            'is_developer' => true,
            'language' => 'nl',
            'timezone' => 'Europe/Brussels',
        ])
            ->withPersonalTeam()
            ->create();

        // -----------------------------------------------------------------------------------
        // create administrator user
        // -----------------------------------------------------------------------------------
        $administrator = User::factory([
            'firstname' => '_',
            'surname' => 'Administrator',
            'email' => 'administrator@genealogy.test',
        ])
            ->withPersonalTeam()
            ->create();

        // -----------------------------------------------------------------------------------
        // create demo teams (owned by administrator)
        // -----------------------------------------------------------------------------------
        $team_british_royals = $this->createTeamBig('administrator@genealogy.test', 'BRITISH ROYALS', 'Part of the British Royal family around Queen Elizabeth II');
        $team_kennedy = $this->createTeamBig('administrator@genealogy.test', 'KENNEDY', 'Part of the Kennedy family around former US President John Fitzgerald Kennedy');

        $administrator->update([
            'current_team_id' => $team_british_royals->id,
        ]);

        $team_british_royals->users()->attach(
            Jetstream::findUserByEmailOrFail($administrator->email),
            ['role' => 'administrator']
        );

        $team_kennedy->users()->attach(
            Jetstream::findUserByEmailOrFail($administrator->email),
            ['role' => 'administrator']
        );

        // -----------------------------------------------------------------------------------
        // create special users
        // -----------------------------------------------------------------------------------
        // manager
        $manager = User::factory([
            'firstname' => '_',
            'surname' => 'Manager',
            'email' => 'manager@genealogy.test',
            'current_team_id' => $team_british_royals->id,
        ])
            ->withPersonalTeam()
            ->create();

        $team_british_royals->users()->attach(
            Jetstream::findUserByEmailOrFail($manager->email),
            ['role' => 'manager']
        );

        // editor
        $editor = User::factory([
            'firstname' => '_',
            'surname' => 'Editor',
            'email' => 'editor@genealogy.test',
            'current_team_id' => $team_kennedy->id,
        ])
            ->withPersonalTeam()
            ->create();

        $team_kennedy->users()->attach(
            Jetstream::findUserByEmailOrFail($editor->email),
            ['role' => 'editor']
        );

        // -----------------------------------------------------------------------------------
        // create normal users (members)
        // -----------------------------------------------------------------------------------
        if (true) {
            for ($i = 1; $i <= 3; $i++) {
                $user = User::factory([
                    'firstname' => '__',
                    'surname' => 'Member ' . $i,
                    'email' => 'member_' . $i . '@genealogy.test',
                    'current_team_id' => $team_british_royals,
                ])
                    ->withPersonalTeam()
                    ->create();

                $team_british_royals->users()->attach(
                    Jetstream::findUserByEmailOrFail($user->email),
                    ['role' => 'member']
                );
            }

            for ($i = 4; $i <= 6; $i++) {
                $user = User::factory([
                    'firstname' => '__',
                    'surname' => 'Member ' . $i,
                    'email' => 'member_' . $i . '@genealogy.test',
                    'current_team_id' => $team_kennedy,
                ])
                    ->withPersonalTeam()
                    ->create();

                $team_kennedy->users()->attach(
                    Jetstream::findUserByEmailOrFail($user->email),
                    ['role' => 'member']
                );
            }

            for ($i = 7; $i <= 10; $i++) {
                $user = User::factory([
                    'firstname' => '___',
                    'surname' => 'Member ' . $i,
                    'email' => 'member_' . $i . '@genealogy.test',
                ])
                    ->withPersonalTeam()
                    ->create();
            }
        }
    }

    // -----------------------------------------------------------------------------------
    protected function createTeamPersonal(User $user, string $suffix = "'s Family", ?string $description = null): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => $user->name . ' ' . $suffix,
            'description' => $description,
            'personal_team' => true,
        ]));
    }

    // -----------------------------------------------------------------------------------
    protected function createTeamBig(string $email, string $name, ?string $description = null): Team
    {
        $user = Jetstream::findUserByEmailOrFail($email);

        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => $name,
            'description' => $description,
            'personal_team' => false,
        ]);

        $user->ownedTeams()->save($team);

        return $team;
    }
}
