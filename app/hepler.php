<?php

use App\Models\Domain;
use App\Models\Team;
use Illuminate\Support\Facades\Session;

if (! function_exists('domainFamilies')) {

    function domainFamilies(): array
    {

        $teams = Domain::whereDomain(Session::get('sub_domain'))->pluck('team_id')->toArray();

        return Team::whereIn('id', $teams)->pluck('name', 'id')->toArray();

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
