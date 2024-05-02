<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckNewFamilyMemberRole
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        dd('dd');
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user has the 'NewFamilyMember' role and hasn't created any 'Person' yet
            if ($user->hasRole(Role::NewFamilyMember) &&
                ! \App\Models\Person::where('created_by', Auth::id())->exists()) {
                // User has the role and hasn't created any 'Person'
                return $next($request);
            }
        }

        // If the user does not meet the criteria, you can redirect them or show an error
        return   redirect('search')->withErrors('You are not allowed to perform this action.');

    }
}
