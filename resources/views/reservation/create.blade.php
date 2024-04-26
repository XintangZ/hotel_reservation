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

                <input type="hidden" name="check_in_date" value="{{ $request->check_in_date }}">
                <input type="hidden" name="check_out_date" value="{{ $request->check_out_date }}">
                <input type="hidden" name="number_of_guests" value="{{ $request->number_of_guests }}">

                <label for="room_type">Room Type:</label>
                <select name="room_type" id="room_type">
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="triple">Triple</option>
                </select>
                <br>
                <br>
            </form>
        </div>
    </div>
</x-app-layout>