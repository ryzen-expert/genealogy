<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class PageController extends Controller
{
    public function home(Request $request)
    {

        // return  Auth::user() ?to_route('people.search') : to_route('login');
//        return to_route('login');
        $homeFile = Jetstream::localizedMarkdownPath('home.md');

        return view('home', [
            'home' => Str::markdown(file_get_contents($homeFile)),
        ]);
    }

    public function about(Request $request)
    {
        $aboutFile = Jetstream::localizedMarkdownPath('about.md');

        return view('about', [
            'about' => Str::markdown(file_get_contents($aboutFile)),
        ]);
    }

    public function help(Request $request)
    {
        $helpFile = Jetstream::localizedMarkdownPath('help.md');

        return view('help', [
            'help' => Str::markdown(file_get_contents($helpFile)),
        ]);
    }
}
