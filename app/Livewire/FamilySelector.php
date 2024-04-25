<?php

namespace App\Livewire;

use App\Actions\Jetstream\AddTeamMember;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Events\AddingTeamMember;
use Laravel\Jetstream\Jetstream;
use Livewire\Component;

class FamilySelector extends Component
{


    public $selectedFamily = null;

    public function submit()
    {


        $user=  Auth::user();

        $user->current_team_id = $this->selectedFamily;
        $user->save();
//        $newTeamMember = Jetstream::findUserByEmailOrFail(($user->email);

//        AddingTeamMember::dispatch($team, $newTeamMember);

//        $team->users()->attach(
//            $newTeamMember, ['role' => $role]
//        );
 //        $user->update(['current_team_id'=>$this->selectedFamily]);

        return to_route('people.search');
//        Auth::user()
//        dd( Auth::user() ,$this->selectedFamily);
        // Here you can add validation or further processing like saving to a database
        // For now, let's log the selected family
//        info('Selected Family ID: ' . $this->selectedFamily);
    }

    public function render()
    {
        $families = Team::where('id', '>', '18')->pluck('name', 'id');
        return view('livewire.family-selector', [
            'families' => $families
        ]);
    }



}
