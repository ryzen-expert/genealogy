<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeopleController extends Controller
{

    public function tree()
    {

        if (!Auth::user()->currentTeam()->first()) {

          return  redirect()->route('choose_family');
        }
//        dd(Auth::user()->currentTeam()->first());
//        dd(Auth::user()->currentTeam()->first()->root_id);
//        $person = Person::whereTeamId( Auth::user()->current_team_id )->first();
        $person = Person::findOrFail(554);
//        $person = Person::find(Auth::user()->currentTeam()->first()->root_id);
//        $person = Person::where('team_id',Auth::user()->current_team_id)->first();
//    dd(Auth::user()->current_team_id,$person);
        if(!$person){
            return to_route('people.add');
        }
        $descendants = collect(DB::select("
            WITH RECURSIVE descendants AS (
                SELECT
                    id, firstname, surname, sex, father_id, mother_id, dob, yob, dod, yod, team_id, photo,
                    0 AS degree,
                    CAST(CONCAT(id, '') AS CHAR(255)) AS sequence
                FROM people
                WHERE deleted_at IS NULL AND id = " . $person->id . "

                UNION ALL

                SELECT p.id, p.firstname, p.surname, p.sex, p.father_id, p.mother_id, p.dob, p.yob, p.dod, p.yod, p.team_id, p.photo,
                    degree + 1 AS degree,
                    CONCAT(d.sequence, ',', p.id) AS sequence
                FROM people p, descendants d
                WHERE deleted_at IS NULL AND (p.father_id = d.id OR p.mother_id = d.id)
            )

            SELECT * FROM descendants ORDER BY degree, dob, yob;
        "));
//        :level_max="$count"
        $level_max = $descendants->max('degree') + 1;
        $level_max = 10;
//        $level_max = 6;
//        dd($descendants);
        return view('people.tree')->with(compact('person' ,'level_max'));

//        dd($person , Auth::user()->current_team_id );
     }


    public function search(): View
    {
        return view('back.people.search');
    }

    public function birthdays($months = 2): View
    {
        $people = Person::whereNotNull('dob')
            ->where('team_id',auth()->user()->current_team_id)
            ->whereRaw('CASE WHEN MONTH(NOW()) +' . $months . " > 12 THEN date_format(dob, '%m-%d') >= date_format(NOW(), '%m-%d') OR date_format(dob, '%m-%d') <= date_format(NOW() + INTERVAL " . $months . " MONTH, '%m-%d') ELSE date_format(dob, '%m-%d') >= date_format(NOW(), '%m-%d') AND date_format(dob, '%m-%d') <= date_format(NOW() + INTERVAL " . $months . " MONTH, '%m-%d') END")
            ->orderByRaw("(case when date_format(dob, '%m-%d') >= date_format(now(), '%m-%d') then 0 else 1 end), date_format(dob, '%m-%d')")
            ->get();

        return view('back.people.birthdays')->with(compact('months', 'people'));
    }

    public function add(): View
    {
        return view('back.people.add');
    }

    public function show(Person $person): View
    {
//        dd($person);
        return view('back.people.show')->with(compact('person'));
    }

    public function ancestors(Person $person): View
    {
        return view('back.people.ancestors')->with(compact('person'));
    }

    public function descendants(Person $person): View
    {
        return view('back.people.descendants')->with(compact('person'));
    }

    public function chart(Person $person): View
    {
        return view('back.people.chart')->with(compact('person'));
    }

    public function addChild(Person $person): View
    {
        return view('back.people.add.child')->with(compact('person'));
    }

    public function addPartner(Person $person): View
    {
        return view('back.people.add.partner')->with(compact('person'));
    }

    public function editContact(Person $person): View
    {
        return view('back.people.edit.contact')->with(compact('person'));
    }

    public function editDeath(Person $person): View
    {
        return view('back.people.edit.death')->with(compact('person'));
    }

    public function editFamily(Person $person): View
    {
        return view('back.people.edit.family')->with(compact('person'));
    }

    public function editPhotos(Person $person): View
    {
        return view('back.people.edit.photos')->with(compact('person'));
    }

    public function editProfile(Person $person): View
    {
        return view('back.people.edit.profile')->with(compact('person'));
    }

    public function editPartner(Couple $couple, Person $person): View
    {
        return view('back.people.edit.partner')->with(compact('couple', 'person'));
    }
}
