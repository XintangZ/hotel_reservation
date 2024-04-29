<x-app-layout>
    <x-slot name="meta">
        <meta name="robots" content="noindex, nofollow">
        <title>{{ __('My Reservations') }}</title>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('successMsg'))
            <x-success-alert>{{ session('successMsg') }}</x-success-alert>
            @endif

            @if($reservations->count() === 0)
            <p class="text-center text-lg font-semibold uppercase tracking-widest text-gray-300 my-12 py-12">{{ __('You have no reservation.') }}</p>
            @else
                @foreach ($reservations as $reservation)
                <div class="bg-gray-50 border border-gray-200 sm:rounded-lg p-4 sm:p-8 md:p-12 mb-8">
                    <p class="bg-blue-100 text-blue-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded-md mb-2">
                        {{ $reservation->number_of_nights }} {{ $reservation->number_of_nights === 1 ? 'night' : 'nights' }}
                    </p>
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

                    @php
                        $isPast = $reservation->check_in_date < \Carbon\Carbon::now()->format('Y-m-d');
                    @endphp

                    <div class="grid grid-cols-2 gap-4 sm:flex justify-end">
                        <form action="{{ route('reservation.delete', $reservation->id) }}" method="post" class="flex justify-center">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button data-modal-target="delete-modal" data-modal-toggle="delete-modal">{{ $isPast ? 'Delete' : 'Cancel'}} Reservation</x-secondary-button>

                            <!-- delete confirmation modal -->
                            <div id="delete-modal" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="delete-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to {{ $isPast ? 'delete' : 'cancel'}} this reservation?</h3>
                                            <x-danger-button type="submit" class="me-2">Yes, delete</x-danger-button>
                                            <x-secondary-button data-modal-hide="delete-modal">No, go back</x-secondary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @if(!$isPast)
                        <div class="flex justify-center">
                            <x-primary-button-a href="{{ route('reservation.edit', $reservation->id) }}">
                                {{ __('Change Reservation' )}}
                            </x-primary-button-a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
            {{ $reservations->links() }}
        </div>
    </div>
</x-app-layout>