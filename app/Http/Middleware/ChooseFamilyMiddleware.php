<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChooseFamilyMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {

            $user = Auth::user();

            if (! $user->currentTeam()->first()) {

//                if (!$user->currentTeam()->first()) {
                    // Redirect to 'choose_family' route if no current team is set
                      redirect()->route('choose_family');
//                redirect()->route('choose_family')->dangerBanner('No Subscription.');
                return $next($request);
//                }
//                 to_route('choose_family');
//                  dd('ss');
//                $next($request);
//                  return  redirect()->route('choose_family');
//                return $next($request);
            }
            //            dd($user->currentTeam()->first(),'dd');
        }

        return $next($request);
    }
}
