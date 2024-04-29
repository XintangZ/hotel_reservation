@php
    $reservationId = isset($params['reservation_id']) ? $params['reservation_id'] : null;
    $reservedRoomId = $reservationId ? App\Models\Reservation::find($params['reservation_id'])->room_id : null;
@endphp

<x-app-layout>
    <x-slot name="meta">
        <meta name="robots" content="noindex, nofollow">
        <title>{{ $reservationId ? __('Change Reservation') : __('New Reservation') }}</title>
    </x-slot>

    <x-slot name="scripts">
        @vite(['resources/js/search.js'])
    </x-slot>

    <x-slot name="header">
        <x-search-query-display 
            checkInDate="{{ $params['check_in_date'] }}"
            checkOutDate="{{ $params['check_out_date'] }}"
            numberOfGuests="{{ $params['number_of_guests'] }}"
        />
    </x-slot>

     <!-- drawer component -->
    <div id="drawer-top-search" class="fixed top-0 left-0 right-0 z-40 w-full py-6 px-4 sm:p-6 transition-transform -translate-y-full bg-white flex justify-center" tabindex="-1" aria-labelledby="drawer-top-label">
        <button type="button" data-drawer-hide="drawer-top-search" aria-controls="drawer-top-search" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center transition ease-in-out duration-150" >
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="w-screen max-w-screen-xl mx-auto lg:px-4 xl:px-8">
            <x-search-form
                checkInDate="{{ $params['check_in_date'] }}"
                checkOutDate="{{ $params['check_out_date'] }}"
                numberOfGuests="{{ $params['number_of_guests'] }}"
                reservationId="{{ $reservationId ?? '' }}"
            >{{ __('Update') }}</x-search-form>
        </div>
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
            <div class="flex justify-center sm:block">
                <h2 class="font-semibold text-3xl lg:text-4xl text-gray-800 leading-tight">Select a Room</h2>
            </div>
            <div class="flex justify-center sm:block">
                <p class="my-3 text-md text-gray-600">{{ $resultCount }} available {{ $resultCount <= 1 ? ' room' : 'rooms'}} found</p>
            </div>
            <form id="reservation-form" action="{{ $reservationId ? route('reservation.update', $params['reservation_id']) : route('reservation.store') }}" method="POST" novalidate>
                @csrf

                <input type="hidden" name="check_in_date" value="{{ $params['check_in_date'] }}">
                <input type="hidden" name="check_out_date" value="{{ $params['check_out_date'] }}">
                <input type="hidden" name="number_of_guests" value="{{ $params['number_of_guests'] }}">

                <div class="flex flex-col">
                    @foreach ($availableRooms as $roomTypeId => $rooms)
                        @php
                            $roomType = \App\Models\RoomType::find($roomTypeId);
                            $roomCount = count($rooms);
                        @endphp
                        @if($roomCount)
                        <div class="shadow border border-grey-200 divide-y mb-5 bg-white has-[:checked]:ring">
                            <x-card :roomType="$roomType"/>
                            <x-accordion :rooms="$rooms" :id="$roomType->id" :reservedRoomId="$reservedRoomId">{{ $roomCount }} {{ $roomCount <= 1 ? 'Room' : 'Rooms' }} Available</x-accordion>
                        </div>
                        @else
                        <div class="order-last shadow border border-grey-200 divide-y mb-5 bg-white has-[:checked]:ring">
                            <x-card :roomType="$roomType"/>
                            <div class="flex items-center justify-between w-full p-5 font-semibold text-gray-500 uppercase tracking-widest font-medium rtl:text-right bg-gray-300 gap-3">Sold Out</div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <x-primary-button id="booking-btn" class="ms-4 sm:ms-0" data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" type="button" disabled>No Room Selected</x-primary-button>

                <!-- confirm booking modal -->
                <div id="confirm-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Confirm Reservation
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition ease-in-out duration-150" data-modal-hide="confirm-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div>
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Room
                                        </th>
                                        <td id="confirm-room" class="px-6 py-4">&nbsp;</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Price
                                        </th>
                                        <td id="confirm-price" class="px-6 py-4">&nbsp;/td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Guest count
                                        </th>
                                        <td id="confirm-guest-count" class="px-6 py-4">&nbsp;/td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Check-in
                                        </th>
                                        <td id="confirm-check-in" class="px-6 py-4">&nbsp;</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Check-out
                                        </th>
                                        <td id="confirm-check-out" class="px-6 py-4">&nbsp;</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Length of stay
                                        </th>
                                        <td id="confirm-nights" class="px-6 py-4">&nbsp;/td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                            Total
                                        </th>
                                        <td id="confirm-total" class="px-6 py-4">&nbsp;/td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b">
                                <x-secondary-button data-modal-hide="confirm-modal" type="button" class="me-2">Cancel</x-secondary-button>
                                <x-primary-button type="submit" id="confirm-booking">Confirm</x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>