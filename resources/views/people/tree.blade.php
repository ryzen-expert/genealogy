@section('title')
    &vert; {{ __('person.tree') }}
@endsection

<x-app-layout>





     <div class="flex flex-wrap gap-5">



         <div class="w-full py-5 space-y-5 xoverflow-x-auto">
        <livewire:family-selector/>

        <livewire:people.heading :person="$person" />



            <div class="min-w-100  md:max-w-max mx-auto  flex flex-col flex-grow gap-5 overflow-x-auto " >

                <livewire:people.descendants :person="$person"  :count="$level_max"    />
            </div>
        </div>



     </div>
</x-app-layout>
