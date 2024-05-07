<div>
    <div class="w-full mb-5">
        <form>
            <div class="p-5 flex flex-col justify-end rounded dark:text-neutral-200 bg-white dark:bg-neutral-700 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
                {{-- header --}}
                <div class="flex flex-wrap mb-2 text-lg">
                    <div class="flex-grow max-w-full flex-1">
                        @if (env('GOD_MODE', 'false') && auth()->user()->is_developer)
                            {!! __('app.people_search', [
                                'scope' => strtoupper(__('team.all_teams')),
                            ]) !!}
                        @else
                            {!! __('app.people_search', [
                                'scope' => auth()->user()->currentTeam->name,
                            ]) !!}
                        @endif
                    </div>

                    <div class="flex-grow max-w-full flex-1 text-end">

{{--                        @dd($this);--}}
                         @if (auth()->user()->hasPermission('person:create') )
                            <x-ts-button href="/people/add" color="emerald" class="text-sm">
                                <x-ts-icon icon="user-plus" class="me-2" />
                                {{ __('person.add_person') }}
                            </x-ts-button>
                        @endif


{{--                             @if ( auth()->user()->hasRole(\App\Role::NewFamilyMember) && \App\Models\Person::where('created_by',\Illuminate\Support\Facades\Auth::id())->doesntExist() )--}}
{{--                                 <x-ts-button href="/people/add" color="emerald" class="text-sm">--}}
{{--                                     <x-ts-icon icon="user-plus" class="me-2" />--}}
{{--                                     {{ __('person.add_person') }}--}}
{{--                                 </x-ts-button>--}}
{{--                             @endif--}}

                    </div>


                </div>

                {{-- search box --}}
                <x-ts-input wire:model.live.debounce.500ms="search" type="search" placeholder="{{ __('app.people_search_placeholder') }}" aria-label="Search" />

                {{-- footer : perpage and pagination --}}
                @if (count($people) > 0)
                    <div class="mt-2 flex flex-wrap gap-2 justify-center items-center">
                        <div class="flex-grow min-w-max max-w-36 flex-1">
                            <x-ts-select.styled wire:model.live="perpage" name="perpage" id="perpage" :options="$options" select="label:label|value:value" required />
                        </div>

                        <div class="flex-grow min-w-max max-w-full flex-1 text-end">
                            {{ $people->links('livewire/pagination/tailwind') }}
                        </div>

                        <div class="flex-grow max-w-full flex-1 text-end">
                            @if ($this->search)
                                @if (env('GOD_MODE', 'false') && auth()->user()->is_developer)
                                    {!! __('app.people_found', [
                                        'total' => $people->total(),
                                        'scope' => strtoupper(__('team.all_teams')),
                                        'keyword' => $this->search,
                                    ]) !!}
                                @else
                                    {!! __('app.people_found', [
                                        'total' => $people->total(),
                                        'scope' => auth()->user()->currentTeam->name,
                                        'keyword' => $this->search,
                                    ]) !!}
                                @endif
                            @else
                                @if (env('GOD_MODE', 'false') && auth()->user()->is_developer)
                                    {!! __('app.people_available', [
                                        'total' => $people_db,
                                        'scope' => strtoupper(__('team.all_teams')),
                                    ]) !!}
                                @else
                                    {!! __('app.people_available', [
                                        'total' => $people_db,
                                        'scope' => auth()->user()->currentTeam->name,
                                    ]) !!}
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>


        </form>
    </div>

    {{-- people grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-5">
        @foreach ($people as $person)
            <livewire:people.person :person="$person" :key="$person->id" />
        @endforeach
    </div>
</div>
