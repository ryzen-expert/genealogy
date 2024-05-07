@section('title')
    &vert; {{ __('person.profile') }}
@endsection

<x-app-layout>
    <x-slot name="heading">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100">
            {{ __('person.profile') }}
        </h2>
    </x-slot>

    <div class="w-full py-5 space-y-5 overflow-x-auto">
        <livewire:people.heading :person="$person" />
        @if (auth()->user()->hasPermission('person:create') ||  $person->hasPermission('person:createOwn'))
            <x-ts-button href="/people/add" color="emerald" class="text-sm">
                <x-ts-icon icon="user-plus" class="me-2" />
                {{ __('person.add_person') }}
            </x-ts-button>
        @endif


        <div class="flex flex-wrap gap-5">
            <div class="min-w-100 md:max-w-max flex flex-col flex-grow gap-5">
                <livewire:people.profile :person="$person" />
            </div>

            <div class="min-w-100 md:max-w-max flex flex-col flex-grow gap-5 p-2">
                <livewire:people.family :person="$person" />
                <livewire:people.partners :person="$person" />
                <livewire:people.children :person="$person" />
                <livewire:people.siblings :person="$person" />
            </div>

            <div class="min-w-100 md:max-w-max flex flex-col flex-grow gap-5 overflow-x-auto">
                <livewire:people.ancestors :person="$person" />
                <livewire:people.descendants :person="$person" />
            </div>
        </div>
    </div>
</x-app-layout>
