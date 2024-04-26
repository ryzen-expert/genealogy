<!DOCTYPE html>
<html dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()" x-bind:class="{ 'dark bg-gray-900': darkTheme, 'bg-gray-100': !darkTheme }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="viewport" content="viewport-fit=cover">--}}
    <title>{{ config('app.name', app()->getLocale()) }} @yield('title') {{ app()->getLocale()}}</title>

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon/favicon-96x96.png') }}" sizes="96x96">

    {{-- fonts --}}
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- scripts --}}
    <tallstackui:script />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/chart.js'])

    {{-- styles --}}
    @livewireStyles
    @filamentStyles
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen mb-10">
        {{-- TallStackUI notifications --}}
        <x-ts-toast />

        {{-- header --}}
{{--        && \Illuminate\Support\Facades\Auth::user()->is_developer/--}}
{{--        @if(!in_array(\Illuminate\Support\Facades\Route::currentRouteName(),['login','register' ,'policy.show','terms.show']))--}}
        @if(\Illuminate\Support\Facades\Auth::check() &&  \Illuminate\Support\Facades\Auth::user()->is_developer )
            You are developer
         @include('layouts.partials.header')
        @endif
        {{-- offcanvas --}}
        @include('layouts.partials.offcanvas')

        {{-- heading --}}
        @if (isset($heading))
            @include('layouts.partials.heading')
        @endif

        {{-- banner --}}
        <x-banner />

        {{-- content --}}
{{--        <main class="mx-auto px-2 md:px-5 flex flex-grow">--}}

        <main class="flex-1 items-center justify-center min-h-screen mx-auto px-2 md:px-5">
            {{ $slot }}

        </main>

        {{-- footer --}}
{{--        @include('layouts.partials.footer')--}}
    </div>


@if(\Illuminate\Support\Facades\Auth::check())
    <div class="btm-nav bg-white">
        <!-- Home Link -->
        <a href="{{ route('people.tree') }}" class="{{ request()->routeIs('login') ? 'active bg-blue-900 text-white' : '' }}">
            <x-ts-icon icon="home" class="size-6 mr-1" />
{{--            <span class="btm-nav-label">{{__('Tree')}}</span>--}}
        </a>

        <!-- Warnings Link -->
        <a href="{{ route('people.search') }}" class="{{ request()->routeIs('people.search') ? 'active bg-blue-900 text-white' : '' }}">
            <x-ts-icon icon="search" class="size-6 mr-1" />
{{--            <span class="btm-nav-label">  {{ __('app.search') }}</span>--}}
        </a>

        <a href="{{ route('people.birthdays') }}" class="{{ request()->routeIs('people.birthdays') ? 'active bg-blue-900 text-white' : '' }}">
            <x-ts-icon icon="cake" class="size-6 mr-1" />
{{--            <span class="btm-nav-label"> {{ __('birthday.birthdays') }}</span>--}}
        </a>

        <!-- Statics Link -->
        <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active bg-blue-900 text-white' : '' }}">
             <x-ts-icon icon="id" class="size-6 mr-1" />
{{--            <span class="btm-nav-label">  {{ __('app.my_profile') }}</span>--}}
        </a>
        <!-- Statics Link -->
        <a href="{{ route('exit') }}" class="{{ request()->routeIs('exit') ? 'active bg-blue-900 text-white' : 'text-white bg-danger-600' }}">
            <x-ts-icon icon="logout" class="size-6   mr-1" />
{{--            <span class="btm-nav-label">   {{ __('auth.logout') }}</span>--}}
        </a>





    </div>
@endif
    {{-- scripts --}}
    @livewireScripts
    @filamentScripts
    @stack('scripts')
    <script>
        function handleClick(event) {
          // alert('dd');
            if (event.target.id === 'logoutText') {
                // Submit the form if the click was on the logout text
                event.currentTarget.form.submit();
            }
        }
    </script>
</body>

</html>
