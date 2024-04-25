<x-app-layout>
    <x-slot name="title">
        {{ __("Home") }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <form action="{{ route('reservation.create') }}" method="GET" class="md:columns-2">                
                <x-date-range-picker />
                <div class="flex justify-evenly">
                    <x-guest-number-input />
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Check Availability</button>
                </div>
            </form>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($rooms as $room)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $room->room_type }}
                        <img src="img/{{ strtolower($room->room_type) }}.jpg" class="w-100" alt="{{ strtolower($room->room_type) }}-room-interior">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
