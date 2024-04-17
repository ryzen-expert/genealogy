<?php

namespace App\Http\Middleware;

use App\Models\Domain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubdomainMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();


        // Split the host by dots and take the first part
        $subdomain = explode('.', $host)[0];

       $domain = Domain::where('is_active',true)
                ->where('is_paid',true)
                ->where('domain',$subdomain)
                ->first();

        Session::put('sub_domain',$subdomain);

//        Session::forget('tree_domain',$domain);


//        dd($domain ,$subdomain,Domain::get(),$subdomain ,Session::get('sub_domain') === env('ADMIN_URL'));
        // Check if it's actually a subdomain and not your main domain
        // This might require customization based on your specific domain structure
        if (!$domain) {
            redirect()->route('home')->dangerBanner('No Subscription.');
            return $next($request);
 //            $request->session()->flash('flash.bannerStyle', 'success');

        }
        Session::put('tree_domain',$domain);
//        Session::put('sub_domain',$subdomain);


        return $next($request);
    }
}
