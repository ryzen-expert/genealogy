<?php

namespace App\Livewire\People;

use Livewire\Component;

class Heading extends Component
{
    public $person;

    // ------------------------------------------------------------------------------
    public function render()
    {
        return view('livewire.people.heading');
    }
}
