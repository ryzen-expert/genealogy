<div class="p-3 pb-0 flex flex-col justify-end rounded dark:text-neutral-200 bg-white dark:bg-neutral-700 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
    <div class="flex flex-wrap">
        <div class="flex-grow max-w-full flex-1 text-lg font-medium">
            {{ $person->full_name }}
        </div>



        <div class="flex-grow max-w-full flex-1 text-end">
            <x-ts-button href="/people/{{ $person->id }}"   color="{{ request()->routeIs('people.show') ? 'primary' : 'secondary' }}" class="  text-sm mr-2 mb-3">
                <x-ts-icon icon="id" class="size-5 mr-1" />
                {{ __('person.profile') }}
            </x-ts-button>

            <x-ts-button href="/people/{{ $person->id }}/ancestors"    color="{{ request()->routeIs('people.ancestors') ? 'primary' : 'secondary' }}" class="text-white text-sm mr-2 mb-3">
                <x-ts-icon icon="binary-tree" class="size-5 mr-1 rotate-180"  />
                {{ __('person.ancestors') }}
            </x-ts-button>

            <x-ts-button href="/people/{{ $person->id }}/descendants"   color="{{ request()->routeIs('people.descendants') ? 'warning' : 'secondary' }}" class="text-white text-sm mr-2 mb-3">
                <x-ts-icon icon="binary-tree" class="size-5 mr-1" />
                {{ __('person.descendants') }}
            </x-ts-button>

            <x-ts-button href="/people/{{ $person->id }}/chart"    color="{{ request()->routeIs('people.chart') ? 'warning' : 'secondary' }}" class="text-white text-sm mr-2 mb-3">
                <x-ts-icon icon="social" class="size-5 mr-1" />
                {{ __('app.family_chart') }}
            </x-ts-button>
        </div>
    </div>
</div>
