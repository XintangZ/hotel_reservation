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

                <div class="row">
                    @foreach ($availableRooms as $roomTypeId => $rooms)
                    @php
                        $roomType = \App\Models\RoomType::find($roomTypeId);
                    @endphp
                    <div class="col-md-6 col-xl-4 flex justify-center mb-5">
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg" src="img/{{ strtolower($roomType->room_type) }}.jpg" alt="{{ strtolower($roomType->room_type) }}-room-interior" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 flex justify-between">
                                        <span>{{ $roomType->room_type }}</span>
                                        <b class="text-[28px]">C${{ $roomType->price_per_night }}</b>
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $rooms->count() }} available rooms</p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Capacity: {{ $roomType->capacity }} guests</p>
                                <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Book Now
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                // TODO: a modal to choose room
                
            </form>
        </div>
    </div>
</x-app-layout>