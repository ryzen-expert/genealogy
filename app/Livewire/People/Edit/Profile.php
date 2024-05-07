<?php

namespace App\Livewire\People\Edit;

use App\Livewire\Forms\People\ProfileForm;
use App\Livewire\Traits\TrimStringsAndConvertEmptyStringsToNull;
use App\Models\Person;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Profile extends Component
{
    use Interactions;
    use TrimStringsAndConvertEmptyStringsToNull;

    // -----------------------------------------------------------------------
    public Person $person;

    public ProfileForm $profileForm;

    // -----------------------------------------------------------------------
    public function mount(): void
    {
        //        dd('dd');
        $this->profileForm->person = $this->person;

        $this->profileForm->firstname = $this->person->firstname;
        $this->profileForm->surname = $this->person->surname;
        $this->profileForm->birthname = $this->person->birthname;
        $this->profileForm->nickname = $this->person->nickname;

//        $this->profileForm->father_name = $this->person->father_name;
//        $this->profileForm->first_grandfather = $this->person->first_grandfather;
//        $this->profileForm->second_grandfather = $this->person->second_grandfather;
//        $this->profileForm->third_grandfather = $this->person->third_grandfather;

        $this->profileForm->sex = $this->person->sex;
        $this->profileForm->gender_id = $this->person->gender_id;

        $this->profileForm->yob = $this->person->yob ? $this->person->yob : null;
        $this->profileForm->dob = $this->person->dob?->format('Y-m-d');
        $this->profileForm->pob = $this->person->pob;
    }

    public function saveProfile()
    {
        if ($this->isDirty()) {
            $validated = $this->profileForm->validate();

//            dd($validated);
            $this->person->update($validated);

            $this->toast()->success(__('app.save'), __('app.saved'))->flash()->send();

            return $this->redirect('/people/' . $this->person->id);
        }
    }

    public function resetProfile(): void
    {
        $this->mount();
    }

    public function isDirty(): bool
    {
        return
        $this->profileForm->firstname != $this->person->firstname or
        $this->profileForm->surname != $this->person->surname or
        $this->profileForm->birthname != $this->person->birthname or
        $this->profileForm->nickname != $this->person->nickname or
//
//        $this->profileForm->father_name != null or
//        $this->profileForm->first_grandfather != null or
//        $this->profileForm->second_grandfather != null or
//        $this->profileForm->third_grandfather != null or

        $this->profileForm->sex != $this->person->sex or
        $this->profileForm->gender_id != $this->person->gender_id or

        $this->profileForm->yob != $this->person->yob or
        $this->profileForm->dob != ($this->person->dob ? $this->person->dob->format('Y-m-d') : null) or
        $this->profileForm->pob != $this->person->pob;
    }
}
