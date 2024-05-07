<div>
    @if (Gate::check('addTeamMember', $team))
        <x-section-border />

        {{-- add team member --}}
        <div class="mt-10 sm:mt-0">
            <x-form-section submit="addTeamMember">
                <x-slot name="title">
                    <div class="dark:text-gray-400">
                        {{ __('Add family Manger') }}
                    </div>
                </x-slot>

                <x-slot name="description">
                    <div class="dark:text-gray-100">
                        {{ __('Add a new family Manger to your family, allowing them to manage with you.') }}
                    </div>
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6">
                        <div class="max-w-xl text-sm text-gray-600">
                            {{ __('Please provide the email address of the person you would like to add to this family.') }}
                        </div>
                    </div>

                    {{-- member email --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" class="mt-1 block w-full" wire:model="addTeamMemberForm.email" />
                        <x-input-error for="email" class="mt-2" />
                    </div>

{{--                    @dd($this)--}}
                    {{-- role --}}
                    @if (count($this->roles) > 0)
                        <div class="col-span-6 lg:col-span-4">
                            <x-label for="role" value="{{ __('Role') }}" />
                            <x-input-error for="role" class="mt-2" />

                            <div class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded cursor-pointer">
                                @foreach ($this->roles as $index => $role)
                                    <button type="button"
                                        class="relative px-4 py-3 inline-flex w-full rounded focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}"
                                        wire:click="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                        <div class="{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                            {{-- role name --}}
                                            <div class="flex items-center">
                                                <div class="text-sm text-gray-600 {{ $addTeamMemberForm['role'] == $role->key ? 'font-semibold' : '' }}">
                                                    {{ $role->name }}
                                                </div>

                                                @if ($addTeamMemberForm['role'] == $role->key)
                                                    <x-ts-icon icon="circle-check" class="size-5 inline-block ms-2 text-emerald-600" />
                                                @endif
                                            </div>

                                            {{-- role description --}}
                                            <div class="mt-2 text-xs text-gray-600 text-start">
                                                {{ $role->description }}
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-action-message class="px-4 py-2 mr-3 rounded bg-success-200 text-emerald-600" role="alert" on="saved">
                        {{ __('app.saved') }}
                    </x-action-message>

                    <x-ts-button color="primary">
                        {{ __('app.add') }}
                    </x-ts-button>
                </x-slot>
            </x-form-section>
        </div>
    @endif

    @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))
        <x-section-border />

        {{-- team member invitations --}}
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    <div class="dark:text-gray-400">
                        {{ __('Pending family Invitations') }}
                    </div>
                </x-slot>

                <x-slot name="description">
                    <div class="dark:text-gray-100">
                        {{ __('These people have been invited to your family and have been sent an invitation email. They may join the family by accepting the email invitation.') }}
                    </div>
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->teamInvitations as $invitation)
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600">{{ $invitation->email }}</div>

                                <div class="flex items-center">
                                    @if (Gate::check('removeTeamMember', $team))
                                        {{-- cancel team invitation --}}
                                        <x-ts-button color="danger" wire:click="cancelTeamInvitation({{ $invitation->id }})">
                                            {{ __('app.cancel') }}
                                        </x-ts-button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    @if ($team->users->isNotEmpty())
        <x-section-border />

        {{-- manange team members --}}
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    <div class="dark:text-gray-400">
                        {{ __('Family Mangers ') }}
                    </div>
                </x-slot>

                <x-slot name="description">
                    <div class="dark:text-gray-100">
                        {{ __('All of the family Mangers') }}
                    </div>
                </x-slot>

                {{-- team member list --}}
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->users->sortBy('name') as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="w-8 h-8 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                    <div class="ms-4">{{ $user->name }}</div>
                                </div>

                                <div class="flex items-center">
                                    {{-- manage team member role --}}
                                    @if (Gate::check('updateTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                        <button class="ms-2 text-sm text-gray-600 underline" wire:click="manageRole('{{ $user->id }}')">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </button>
                                    @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                        <div class="ms-2 text-sm text-gray-600">
                                            {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                        </div>
                                    @endif

                                    {{-- leave team --}}
                                    @if ($this->user->id === $user->id)
                                        <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="$toggle('confirmingLeavingTeam')">
                                            {{ __('Leave') }}
                                        </button>

                                        {{-- remove team member --}}
                                    @elseif (Gate::check('removeTeamMember', $team))
                                        <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="confirmTeamMemberRemoval('{{ $user->id }}')">
                                            {{ __('Remove') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    {{-- role management modal --}}
    <x-dialog-modal wire:model.live="currentlyManagingRole">
        <x-slot name="title">
            {{ __('Manage Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="relative z-0 mt-1 border border-gray-200 dark:border-gray-700 rounded cursor-pointer">
                @foreach ($this->roles as $index => $role)
                    <button type="button"
                        class="relative px-4 py-3 inline-flex w-full rounded focus:z-10 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 {{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }}"
                        wire:click="$set('currentRole', '{{ $role->key }}')">
                        <div class="{{ $currentRole !== $role->key ? 'opacity-75' : '' }}">
                            {{-- role name --}}
                            <div class="flex items-center">
                                <div class="text-sm text-gray-600 {{ $currentRole == $role->key ? 'font-semibold' : '' }}">
                                    {{ $role->name }}
                                </div>

                                @if ($currentRole == $role->key)
                                    <x-ts-icon icon="circle-check" class="size-5 inline-block ms-2 text-emerald-600" />
                                @endif
                            </div>

                            {{-- role description --}}
                            <div class="mt-2 text-xs text-gray-600">
                                {{ $role->description }}
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-ts-button color="secondary" wire:click="stopManagingRole" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-ts-button>

            <x-ts-button color="primary" class="ms-3" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-ts-button>
        </x-slot>
    </x-dialog-modal>

    {{-- leave team confirmation modal --}}
    <x-confirmation-modal wire:model.live="confirmingLeavingTeam">
        <x-slot name="title">
            {{ __('Leave Family') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to leave this family?') }}
        </x-slot>

        <x-slot name="footer">
            <x-ts-button color="secondary" wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-ts-button>

            <x-ts-button color="danger" class="ms-3" wire:click="leaveTeam" wire:loading.attr="disabled">
                {{ __('Leave') }}
            </x-ts-button>
        </x-slot>
    </x-confirmation-modal>

    {{-- remove team member confirmation modal --}}
    <x-confirmation-modal wire:model.live="confirmingTeamMemberRemoval">
        <x-slot name="title">
            {{ __('Remove Family Member') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to remove this person from the family?') }}
        </x-slot>

        <x-slot name="footer">
            <x-ts-button color="secondary" wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-ts-button>

            <x-ts-button color="danger" class="ms-3" wire:click="removeTeamMember" wire:loading.attr="disabled">
                {{ __('Remove') }}
            </x-ts-button>
        </x-slot>
    </x-confirmation-modal>
</div>
