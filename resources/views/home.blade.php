<x-app-layout>
    <x-slot name="title">
        {{ __("Home") }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-date-range-picker />
            <a href="{{ route('reservation.create') }}">New reservation</a>
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
