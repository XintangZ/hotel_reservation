<x-app-layout>
    <x-slot name="title">
        {{ __('New Reservation') }}
    </x-slot>

    <x-slot name="header">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-12 gap-4">
            <div class="xl:col-span-4">
                <x-input-label for="check_in_date" :value="__('Check-in Date')" />
                <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" value="{{ $params['check_in_date'] }}" min="{{ \Carbon\Carbon::today()->toDateString() }}" :disabled="true" />
            </div>
            <div class="xl:col-span-4">
                <x-input-label for="check_out_date" :value="__('Check-out Date')" />
                <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" value="{{ $params['check_out_date'] }}" :disabled="true" />
            </div>
            <div class="xl:col-span-2">
                <x-input-label for="number_of_guests" :value="__('Number of Guests')" />
                <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" value="{{ $params['number_of_guests'] }}" :disabled="true" />
            </div>
            <div class="flex flex-col-reverse xl:col-span-2">
                <x-primary-button class="h-[42px] mt-1 justify-center" type="button" data-drawer-target="drawer-top-search" data-drawer-show="drawer-top-search" data-drawer-placement="top" data-drawer-body-scrolling="true" aria-controls="drawer-top-search">
                    {{ __('Edit Reservation Info') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

     <!-- drawer component -->
     <div id="drawer-top-search" class="fixed top-0 left-0 right-0 z-40 w-full p-6 transition-transform -translate-y-full bg-white" tabindex="-1" aria-labelledby="drawer-top-label">
        <button type="button" data-drawer-hide="drawer-top-search" aria-controls="drawer-top-search" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center" >
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        @include('layouts.search_form', $params)
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @php
                $resultCount = count(\Illuminate\Support\Arr::flatten($availableRooms));
            @endphp
            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">Select a Room</h2>
            <p class="my-3 text-md text-gray-600">{{$resultCount}} available {{ $resultCount === 1 ? ' room' : 'rooms'}} found</p>
            <form action="{{ route('reservation.store') }}" method="POST">
                @csrf

                <input type="hidden" name="check_in_date" value="{{ $params['check_in_date'] }}">
                <input type="hidden" name="check_out_date" value="{{ $params['check_out_date'] }}">
                <input type="hidden" name="number_of_guests" value="{{ $params['number_of_guests'] }}">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($availableRooms as $roomTypeId => $rooms)

                    @php
                        $roomType = \App\Models\RoomType::find($roomTypeId);
                    @endphp
                    
                    <div class="flex justify-center">
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                            <a href="#">
                                <img class="rounded-t-lg" src="/img/{{ strtolower($roomType->room_type) }}.jpg" alt="{{ strtolower($roomType->room_type) }}-room-interior" />
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 flex justify-between">
                                        <span>{{ $roomType->room_type }}</span>
                                        <b class="text-[28px]">C${{ $roomType->price_per_night }}</b>
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700">
                                    {{ $rooms->count() }} {{ $rooms->count() === 1 ? 'room' : 'rooms' }} available<br>
                                    Capacity: {{ $roomType->capacity }} {{ $roomType->capacity === 1 ? 'guest' : 'guests' }}
                                </p>
                                <button data-modal-target="select-{{ $roomType->room_type }}-modal" data-modal-toggle="select-{{ $roomType->room_type }}-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" type="button">
                                Book Now
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </button>

                                <!-- Main modal -->
                                <div id="select-{{ $roomType->room_type }}-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    Available {{ $roomType->room_type }} Rooms
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="select-{{ $roomType->room_type }}-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5">
                                                <p class="text-gray-500">Select a room:</p>
                                                <ul class="space-y-4 mb-4">
                                                    @foreach($rooms as $room)
                                                    <li>
                                                        <input type="radio" id="{{ $room->id }}" name="room_id" value="{{ $room->id }}" class="hidden peer" required />
                                                        <label for="{{ $room->id }}" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100">                           
                                                            <div class="block">
                                                                <div class="w-full text-lg font-semibold">{{ $room->room_number }}</div>
                                                                <div class="w-full text-gray-500">Flowbite</div>
                                                                <!-- TODO: add price -->
                                                            </div>
                                                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
                                                        </label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <button class="text-white inline-flex w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">
                                                    Confirm Reservation
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</x-app-layout>