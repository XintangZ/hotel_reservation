<x-app-layout>
    <x-slot name="title">
        {{ __('New Reservation') }}
    </x-slot>

    <x-slot name="header">
        <x-search-form 
            checkInDate="{{ $params['check_in_date'] }}"
            checkOutDate="{{ $params['check_out_date'] }}"
            numberOfGuests="{{ $params['number_of_guests'] }}"
            disabled
        />
    </x-slot>

     <!-- drawer component -->
    <div id="drawer-top-search" class="fixed top-0 left-0 right-0 z-40 w-full p-6 transition-transform -translate-y-full bg-white" tabindex="-1" aria-labelledby="drawer-top-label">
        <button type="button" data-drawer-hide="drawer-top-search" aria-controls="drawer-top-search" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center" >
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <x-search-form 
            checkInDate="{{ $params['check_in_date'] }}"
            checkOutDate="{{ $params['check_out_date'] }}"
            numberOfGuests="{{ $params['number_of_guests'] }}"
        />
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <x-error-alert>
                    @foreach ($errors->all() as $error)
                    <x-input-error class="mt-2" :messages="$error" />
                    @endforeach
                </x-error-alert>
            @endif

            @php
                $resultCount = count(\Illuminate\Support\Arr::flatten($availableRooms));
            @endphp
            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Select a Room</h2>
            <p class="my-3 text-md text-gray-600">{{ $resultCount }} available {{ $resultCount <= 1 ? ' room' : 'rooms'}} found</p>
            <form action="{{ route('reservation.store') }}" method="POST" novalidate>
                @csrf

                <input type="hidden" name="check_in_date" value="{{ $params['check_in_date'] }}">
                <input type="hidden" name="check_out_date" value="{{ $params['check_out_date'] }}">
                <input type="hidden" name="number_of_guests" value="{{ $params['number_of_guests'] }}">

                @foreach ($availableRooms as $roomTypeId => $rooms)
                    @php
                        $roomType = \App\Models\RoomType::find($roomTypeId);
                        $roomCount = count($rooms);
                    @endphp
                    <div class="shadow border border-grey-200 divide-y mb-5 bg-white has-[:checked]:border-gray-600">
                        <x-card :roomType="$roomType"/>
                        <x-accordion :rooms="$rooms" :id="$roomType->id">{{ $roomCount }} {{ $roomCount <= 1 ? 'Room' : 'Rooms' }} Available</x-accordion>
                    </div>
                @endforeach

                <x-primary-button>
                  Book Now
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>