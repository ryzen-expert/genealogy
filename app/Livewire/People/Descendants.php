<?php

namespace App\Livewire\People;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Descendants extends Component
{
    public $person;

    public $descendants;

    public $count = 4; // default

    public $count_min = 1;

    public $count_max = 10;

    public $zoomLevel = 2; // Default zoom level

    public $scale = 0.4;

    public $origin = '0% 0% 0px';

    public function zoomIn()
    {
        $this->scale += 0.1;  // Increase scale
    }

    public function zoomOut()
    {
        $this->scale = max(0.2, $this->scale - 0.1);  // Decrease scale but not below 0.1
    }

    public function performAction()
    {
        // Your server-side logic here

        // Dispatch a browser event with optional data
        $this->zoomLevel = min(10, $this->zoomLevel + 1);
        $this->dispatch('zoomChanged', ['zoomLevel' => $this->zoomLevel]);
        $this->render();
    }

    //    public function zoomIn()
    //    {
    //        $this->zoomLevel = min(10, $this->zoomLevel + 1); // Increment zoom, max of 10
    //        $this->dispatch('zoomChanged', ['zoomLevel' => $this->zoomLevel]);
    //    }
    //
    //    public function zoomOut()
    //    {
    //        $this->zoomLevel = max(1, $this->zoomLevel - 1); // Decrement zoom, min of 1
    //        $this->dispatch('zoomChanged', ['zoomLevel' => $this->zoomLevel]);
    //    }

    // ------------------------------------------------------------------------------
    public function increment()
    {
        if ($this->count < $this->count_max) {
            $this->count++;
        }
    }

    public function decrement()
    {
        if ($this->count > $this->count_min) {
            $this->count--;
        }
    }

    public function mount()
    {
        $this->descendants = collect(DB::select("
            WITH RECURSIVE descendants AS (
                SELECT
                    id, firstname, surname, sex, father_id, mother_id, dob, yob, dod, yod, team_id, photo,
                    0 AS degree,
                    CAST(CONCAT(id, '') AS CHAR(255)) AS sequence
                FROM people
                WHERE deleted_at IS NULL AND id = " . $this->person->id . "

                UNION ALL

                SELECT p.id, p.firstname, p.surname, p.sex, p.father_id, p.mother_id, p.dob, p.yob, p.dod, p.yod, p.team_id, p.photo,
                    degree + 1 AS degree,
                    CONCAT(d.sequence, ',', p.id) AS sequence
                FROM people p, descendants d
                WHERE deleted_at IS NULL AND (p.father_id = d.id OR p.mother_id = d.id)
            )

            SELECT * FROM descendants ORDER BY degree, dob, yob;
        "));

        $this->count_max = $this->descendants->max('degree') + 1;

        if ($this->count > $this->count_max) {
            $this->count = $this->count_max;
        }
    }

    // ------------------------------------------------------------------------------
    public function render()
    {
        return view('livewire.people.descendants');
    }
}
