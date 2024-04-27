
@section('title')
    &vert; {{ __('app.error') }}
@endsection

<x-app-layout>


    <div class="flex flex-col justify-center items-center bg-white h-screen">
        <div class="flex flex-col items-center">
            <div>
                <x-authentication-card-logo />
                <p class="text-danger-600">Something went wrong!   {{\Illuminate\Support\Facades\Auth::check()}}</p>
            </div>

            <x-button  href="{{  \Illuminate\Support\Facades\Auth::check() ? route('people.search') : route('login')}}" class="mt-2"
                       text="{{__('Back to Home')}}" color="red" outline />

        </div>
    </div>

</x-app-layout>
