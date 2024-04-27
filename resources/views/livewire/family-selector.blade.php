<div class=" bg-white ">
{{--    <x-authentication-card header="{{__('Choose Family')}}">--}}
        <div class="md:flex md:items-center p-4  ">
{{--            <div class="md:w-1/3">--}}
{{--                <x-label for="family" value="{{ __('Family') }} :" />--}}
{{--            </div>--}}
{{--            <div class="md:w-2/3">--}}

                <select wire:change="submit" wire:model="selectedFamily" id="family" class="block w-full rounded" name="family" required>
                    <option value=""> {{__('choose family')}} </option>

                    @foreach ($this->families as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
{{--            </div>--}}
        </div>
</div>
