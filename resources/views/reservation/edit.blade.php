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
            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <label for="check_in_date">Check-in Date:</label>
                <input type="date" name="check_in_date" id="check_in_date" value="{{ $reservation->check_in_date }}">
                <br>
                <br>

                <label for="check_out_date">Check-out Date:</label>
                <input type="date" name="check_out_date" id="check_out_date" value="{{ $reservation->check_out_date }}">
                <br>
                <br>

                <label for="room_type">Room Type:</label>
                <select name="room_type" id="room_type">
                    <option value="single">Single</option>
                    <option value="double">Double</option>
                    <option value="triple">Triple</option>
                </select>
                <br>
                <br>

                <label for="number_of_guests">Number of Guests:</label>
                <input type="number" name="number_of_guests" id="number_of_guests" value="{{ $reservation->number_of_guests }}">
                <br>
                <br>

                <button>Submit</button>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>