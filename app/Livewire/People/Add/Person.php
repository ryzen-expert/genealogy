<?php

namespace App\Livewire\People\Add;

use App\Livewire\Forms\People\PersonForm;
use App\Livewire\Traits\TrimStringsAndConvertEmptyStringsToNull;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Person extends Component
{
    use Interactions;
    use TrimStringsAndConvertEmptyStringsToNull;
    use WithFileUploads;

    // -----------------------------------------------------------------------
    public PersonForm $personForm;

    // -----------------------------------------------------------------------
    public function mount(): void
    {
        $this->personForm->firstname = null;
        $this->personForm->surname = null;
        $this->personForm->birthname = null;
        $this->personForm->nickname = null;

        $this->personForm->father_name = null;
        $this->personForm->first_grandfather = null;
        $this->personForm->second_grandfather = null;
        $this->personForm->third_grandfather = null;

        $this->personForm->sex = null;
        $this->personForm->gender_id = null;

        $this->personForm->yob = null;
        $this->personForm->dob = null;
        $this->personForm->pob = null;

        $this->personForm->photo = null;
        $this->personForm->image = null;

        $this->personForm->team_id = auth()->user()->current_team_id;
    }

    public function savePerson()
    {
        if ($this->isDirty()) {
            $validated = $this->personForm->validate();
            //            dd($validated);
            $person = \App\Models\Person::create($validated);

            if ($this->personForm->image) {
                // if needed, create team photo folder
                $path = storage_path('app/public/photos/' . $this->personForm->team_id);

                if (! File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                // upload (new) photo
                $image_width = intval(env('IMAGE_UPLOAD_MAX_WIDTH', 600));
                $image_height = intval(env('IMAGE_UPLOAD_MAX_HEIGHT', 800));
                $image_quality = intval(env('IMAGE_UPLOAD_QUALITY', 80));
                $image_type = env('IMAGE_UPLOAD_TYPE', 'webp');
                $image_name = $this->personForm->team_id . '/' . $person->id . '_001_' . now()->format('YmdHis') . '.' . $image_type;

                // resize (new) photo, add watermark and save it
                $manager = new ImageManager(new Driver());
                $new_image = $manager->read($this->personForm->image)
                    ->scaleDown(width: $image_width, height: $image_height)
                    ->place(public_path('img/watermark.png'), 'bottom-left', 5, 5)
                    ->toWebp(quality: $image_quality);

                if ($new_image) {
                    $new_image->save(storage_path('app/public/photos/' . $image_name));

                    $person->update(['photo' => $image_name]);

                    // reset photo upload input
                    $this->personForm->image = null;
                    $this->personForm->iteration++;
                } else {
                    $this->toast()->error(__('app.save'), __('app.image_not_saved') . '.')->flash()->send();
                }
            }

            $this->toast()->success(__('app.save'), $person->name . ' ' . __('app.created'))->flash()->send();

            return $this->redirect('/people/' . $person->id);
        }
    }

    public function resetPerson(): void
    {
        $this->mount();
    }

    public function isDirty(): bool
    {
        return
        $this->personForm->firstname != null or
        $this->personForm->father_name != null or
        $this->personForm->first_grandfather != null or
        $this->personForm->second_grandfather != null or
        $this->personForm->third_grandfather != null or

        $this->personForm->surname != null or
        $this->personForm->birthname != null or
        $this->personForm->nickname != null or

        $this->personForm->sex != null or
        $this->personForm->gender_id != null or

        $this->personForm->yob != null or
        $this->personForm->dob != null or
        $this->personForm->pob != null or

        $this->personForm->image != null;
    }

    // ------------------------------------------------------------------------------
    public function render()
    {

        return view('livewire.people.add.person');
    }
}
