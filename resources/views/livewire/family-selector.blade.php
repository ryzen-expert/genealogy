<div>
    <x-authentication-card header="{{__('Choose Family')}}">
        <div class="md:flex md:items-center mt-2">
            <div class="md:w-1/3">
                <x-label for="family" value="{{ __('Family') }} :" />
            </div>
            <div class="md:w-2/3">
                <select wire:model="selectedFamily" id="family" class="block w-full rounded" name="family" required>
                    @foreach ($families as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-3" wire:click="submit">
                {{ __('Submit') }}
            </x-button>
        </div>
    </x-authentication-card>
</div>
