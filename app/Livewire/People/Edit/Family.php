<?php

namespace App\Livewire\People\Edit;

use App\Livewire\Forms\People\FamilyForm;
use App\Livewire\People\Ancestors;
use App\Livewire\Traits\TrimStringsAndConvertEmptyStringsToNull;
use App\Models\Couple;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Family extends Component
{
    use Interactions;
    use TrimStringsAndConvertEmptyStringsToNull;

    // -----------------------------------------------------------------------
    public $person;

    public FamilyForm $familyForm;

    // -----------------------------------------------------------------------
    public function mount(): void
    {
        $this->familyForm->father_id = $this->person->father_id;
        $this->familyForm->mother_id = $this->person->mother_id;
        $this->familyForm->parents_id = $this->person->parents_id;
    }

    public function saveFamily()
    {
        if ($this->isDirty()) {
            $validated = $this->familyForm->validate();
            $father =   Person::findOrFail( $validated['father_id']);
            $ancestors = getAncestors($father) ;
//          dd($father ,$ancestors , $validated['father_id']);
            $this->person->father_name = $father?->firstname ?? null ;
            $this->person->first_grandfather = $ancestors->firstWhere('degree', 1)->firstname;
            $this->person->second_grandfather = $ancestors->firstWhere('degree', 2)->firstname;
            $this->person->third_grandfather = $ancestors->firstWhere('degree', 3)->firstname;
            $this->person->save();


//            dd( $this->person ,);
            $this->person->update($validated);

//

//                dd(getAncestors($this->person) ,$this->person->second_grandfather, $this->person ,$ancestors);

            $this->toast()->success(__('app.save'), __('app.saved'))->flash()->send();

            return $this->redirect('/people/' . $this->person->id);
        }
    }

    public function resetFamily(): void
    {
        $this->mount();
    }

    public function isDirty(): bool
    {
        return
        $this->familyForm->father_id != $this->person->father_id or
        $this->familyForm->mother_id != $this->person->mothe_id or
        $this->familyForm->parents_id != $this->person->parents_id;
    }

    // ------------------------------------------------------------------------------
    public function render()
    {
        $persons = Person::where('id', '!=', $this->person->id)
            ->OlderThan($this->person->birth_date, $this->person->birth_year)
            ->orderBy('firstname')->orderBy('surname')
            ->get();
//        dd(Auth::user()->current_team_id);
        $fathers = $persons->where('sex', 'm')->map(function ($p) {

//            dd( $p,  $p?->team ,$p?->team?->name);
//            if(Auth::user()->current_team_id === $p->team_id){
            return [
                'id' => $p->id,
                'name' => $p->name . ' (' . $p->birth_formatted . ')',
            ];
//            }
        })->filter()->values()->toArray();

//        dd($fathers);
        $mothers = $persons->where('sex', 'f')->map(function ($p) {
            return [
                'id' => $p->id,
                'team' => $p->team_id,
//                 'description' => __('team.team') .' '. $p->team->name,
                'name' => $p->name . ' [' . strtoupper($p->sex) . '] (' . $p->birth_formatted . ')',

//                'id' => $p->id,
//                'name' => $p->name . ' (' . $p->birth_formatted . ')' .''.$p?->team?->name,
            ];
        })->values()->toArray();



        $parents = Couple::with(['person_1', 'person_2'])
            ->OlderThan($this->person->birth_date)
            ->get()
            ->sortBy('name')
            ->map(function ($couple) {
                return [
                    'id' => $couple->id,
                    'couple' => $couple->name . (($couple->date_start) ? ' (' . $couple->date_start_formatted . ')' : ''),
                ];
            })->values()->toArray();

        return view('livewire.people.edit.family')->with(compact('fathers', 'mothers', 'parents'));
    }
}
