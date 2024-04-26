<x-app-layout>
    <x-slot name="title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('successMsg'))
            <p>{{ session('successMsg') }}</p>
            @endif

            @foreach ($reservations as $reservation)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 md:p-12 mb-8">
                <a href="#" class="bg-blue-100 text-blue-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded-md mb-2">
                    {{ $reservation->number_of_nights }} {{ $reservation->number_of_nights === 1 ? 'night' : 'nights' }}
                </a>
                <div class="grid sm:grid-cols-2">
                    <h1 class="text-gray-900 text-xl sm:text-2xl lg:text-3xl font-extrabold mb-2">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($reservation->check_out_date)->format('M d, Y') }}</h1>
                    <h1 class="text-gray-900 text-xl sm:text-2xl lg:text-3xl font-extrabold mb-2 sm:text-end">
                        C${{ $reservation->total_price }}
                    </h1>
                </div>
                <p class="text-lg font-normal text-gray-500 mb-6">
                    {{ $reservation->room()->first()->roomType()->first()->room_type }} - #{{ $reservation->room()->first()->room_number }}<br>
                    {{ $reservation->number_of_guests }} {{ $reservation->number_of_guests === 1 ? 'Guest' : 'Guests' }}
                </p>
                <div class="grid grid-cols-2 gap-4 sm:flex justify-end">
                    @if($reservation->check_in_date > \Carbon\Carbon::now()->format('Y-m-d'))
                    <form action="{{ route('reservation.delete', $reservation->id) }}" method="post" class="flex justify-center">
                        @csrf
                        @method('DELETE')
                        <x-secondary-button type="submit">Cancel Reservation</x-secondary-button>
                    </form>
                    <div class="flex justify-center">
                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Change Reservation
                        </a>
                    </div>
                    @else
                    <div class="flex justify-center">
                        <!-- TODO: book the same room again -->
                        <form action="{{ route('reservation.create', $reservation->room_id) }}" method="get">
                            <x-secondary-button type="submit">Book Again</x-secondary-button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            {{ $reservations->links() }}
        </div>
    </div>
</x-app-layout>