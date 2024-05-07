<?php

use App\Models\Domain;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

if (! function_exists('domainFamilies')) {

    function domainFamilies(): array
    {

        $teams = Domain::whereDomain(Session::get('sub_domain'))->pluck('team_id')->toArray();

        return Team::whereIn('id', $teams)->pluck('name', 'id')->toArray();

    }

}



if (! function_exists('getAncestors')) {

    function getAncestors($person): \Illuminate\Support\Collection
    {

//        dd($person);
         return collect(DB::select("
            WITH RECURSIVE ancestors AS ( 
	            SELECT 
                    id, firstname, surname, sex, father_id, mother_id, dod, yod, team_id, photo, 
		            0 AS degree,
                    CAST(CONCAT(id, '') AS CHAR(255)) AS sequence
	            FROM people  
	            WHERE deleted_at IS NULL AND sex='m' AND id = " . $person->id . " 
    
	            UNION ALL 
    
	            SELECT p.id, p.firstname, p.surname, p.sex, p.father_id, p.mother_id, p.dod, p.yod, p.team_id, p.photo,
		            degree + 1 AS degree,
                    CONCAT(a.sequence, ',', p.id) AS sequence
	            FROM people p, ancestors a 
	            WHERE deleted_at IS NULL AND (p.id = a.father_id OR p.id = a.mother_id)
            ) 
        
            SELECT * FROM ancestors ORDER BY degree, sex DESC;
        "));


//             ->map(function ($ancestor) {
//
//                    'firstname'=>$ancestor->firstname,
//                    'firstname'=>$ancestor->firstname,
//                dd($ancestor);
//         });



    }
}

if (! function_exists('domainFamiliesIds')) {

    function domainFamiliesIds(): array
    {

        return array_keys(domainFamilies());

        //        $teams = Domain::whereDomain(Session::get('sub_domain'))->pluck('team_id')->toArray();
        //
        //        return Team::whereIn('id', $teams)->pluck('name', 'id')->toArray();

    }


    if (! function_exists('AllFamilies')) {

        function AllFamilies(): array
        {

//            $teams = Domain::whereDomain(Session::get('sub_domain'))->pluck('team_id')->toArray();

            return Team::where('id','>=' ,19)->pluck('name', 'id')->toArray();

        }

    }
}
