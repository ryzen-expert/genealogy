<?php

namespace App\Livewire\Forms\People;

use App\Models\Gender;
use App\Rules\DobValid;
use App\Rules\YobValid;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonForm extends Form
{
    // -----------------------------------------------------------------------
    public $person = null;

    // -----------------------------------------------------------------------
    public $image = null;       // file upload input

    public $iteration = 0;      // needed for reset upload input

    // -----------------------------------------------------------------------
    public $firstname = null;

    public $surname = null;

    public $birthname = null;

    public $nickname = null;

    public $sex = null;

    public $gender_id = null;

    #[Validate]
    public $yob = null;

    #[Validate]
    public $dob = null;

    public $pob = null;

    public $photo = null;

    public $team_id = null;

    // -----------------------------------------------------------------------
    #[Computed(persist: true, seconds: 3600, cache: true)]
    public function genders()
    {
        return Gender::select('id', 'name')->orderBy('name')->get()->toArray();
    }

    public function rules()
    {
        return $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'birthname' => ['nullable', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],

            'sex' => ['required', 'in:m,f'],
            'gender_id' => ['nullable', 'integer'],

            'yob' => [
                'nullable',
                'integer',
                'min:1',
                'max:' . date('Y'),
                new YobValid,
            ],
            'dob' => [
                'nullable',
                'date_format:Y-m-d',
                'before_or_equal:today',
                new DobValid,
            ],
            'pob' => ['nullable', 'string', 'max:255'],

            'photo' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'sometimes', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:1024'],

            'team_id' => ['nullable', 'integer'],
        ];
    }

    public function messages()
    {
        return [];
    }

    public function validationAttributes()
    {
        return [
            'firstname' => __('person.firstname'),
            'surname' => __('person.surname'),
            'birthname' => __('person.birthname'),
            'nickname' => __('person.nickname'),

            'sex' => __('person.sex'),
            'gender_id' => __('person.gender'),

            'yob' => __('person.yob'),
            'dob' => __('person.dob'),
            'pob' => __('person.pob'),

            'photo' => __('person.photo'),
            'image' => __('person.photo'),

            'team_id' => __('person.team'),
        ];
    }
}
