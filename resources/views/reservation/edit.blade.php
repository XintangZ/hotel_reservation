<x-app-layout>
    <x-slot name="title">
        {{ __('Edit Reservation') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <x-input-label for="check_in_date" :value="__('Check-in Date')" />
                    <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" :value="old('check_in_date', $reservation->check_in_date)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('check_in_date')" />
                </div>

                <div>
                    <x-input-label for="check_out_date" :value="__('Check-out Date')" />
                    <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" :value="old('check_out_date', $reservation->check_out_date)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('check_out_date')" />
                </div>

                <div>
                    <label for="room_type">Room Type:</label>
                    <select name="room_type" id="room_type">
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="triple">Triple</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="number_of_guests" :value="__('Number of Guests')" />
                    <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" :value="old('number_of_guests', $reservation->number_of_guests)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('number_of_guests')" />
                </div>

                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>