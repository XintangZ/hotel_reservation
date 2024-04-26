<x-app-layout>
    <x-slot name="title">
        {{ __('New Reservation') }}
    </x-slot>

    <x-slot name="header">
        @include('layouts.search_form')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf

                <input type="hidden" name="check_in_date" value="{{ $params['check_in_date'] }}">
                <input type="hidden" name="check_out_date" value="{{ $params['check_out_date'] }}">
                <input type="hidden" name="number_of_guests" value="{{ $params['number_of_guests'] }}">

                @foreach ($availableRooms as $key => $roomType)
                    <p>{{ $key }}</p>
                    @foreach($roomType as $room) 
                        <p>{{ $room->room_number }}</p>
                    @endforeach
                @endforeach
            </form>
        </div>
    </div>
</x-app-layout>