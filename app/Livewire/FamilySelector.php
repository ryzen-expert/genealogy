<?php

namespace App\Livewire;

use App\Models\Domain;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Jetstream\Events\AddingTeamMember;
use Laravel\Jetstream\Jetstream;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FamilySelector extends Component
{
    //    public $families;

    public $selectedFamily = null;

    #[Computed]
    public function families(): Collection
    {

        $teams = Domain::whereDomain(Session::get('sub_domain'))->pluck('team_id')->toArray();

        return Team::whereIn('id', $teams)->pluck('name', 'id');

    }

    public function submit()
    {

        //        dd('dd' ,$this);

        $user = Auth::user();

        $user->current_team_id = $this->selectedFamily;
        $user->save();


              $this->redirect(route('people.tree'),true);
//        dd($user);
        //        $newTeamMember = Jetstream::findUserByEmailOrFail(($user->email);

        //        AddingTeamMember::dispatch($team, $newTeamMember);

        //        $team->users()->attach(
        //            $newTeamMember, ['role' => $role]
        //        );
        //        $user->update(['current_team_id'=>$this->selectedFamily]);

//        return to_route('people.tree');
        //        Auth::user()
        //        dd( Auth::user() ,$this->selectedFamily);
        // Here you can add validation or further processing like saving to a database
        // For now, let's log the selected family
        //        info('Selected Family ID: ' . $this->selectedFamily);
    }

    public function render()
    {

        return view('livewire.family-selector');
    }
}
