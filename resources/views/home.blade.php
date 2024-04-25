<x-app-layout>
    <x-slot name="title">
        {{ __('Home') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('reservation.create') }}">New reservation</a>
            @if (session('successMsg'))
            <p>{{ session('successMsg') }}</p>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>First  Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Room Type</th>
                        <th>Number of Guests</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->first_name }}</td>
                        <td>{{ $reservation->last_name }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->check_in_date }}</td>
                        <td>{{ $reservation->check_out_date }}</td>
                        <td>{{ $reservation->room_type }}</td>
                        <td>{{ $reservation->number_of_guests }}</td>
                        <td>
                            <a href="{{ route('reservation.edit', $reservation->id) }}">Edit</a>
                            <form action="{{ route('reservation.delete', $reservation->id) }}"" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reservations->links() }}
        </div>
    </div>
</x-app-layout>