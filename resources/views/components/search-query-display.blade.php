<div class="sm:flex gap-4">
    <div class="flex flex-wrap content-center me-2 mb-2 sm:mb-0">
        <div class="flex content-center mb-2 sm:mb-0">
            <div class="flex items-center me-2">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                </svg>
            </div>
            <h1>
                <span class="text-gray-900 text-xl xl:text-2xl font-extrabold">
                    <span id="selected-check-in-date">{{ \Carbon\Carbon::parse($checkInDate)->format('M d, Y') }}</span>
                     - <span id="selected-check-out-date">{{ \Carbon\Carbon::parse($checkOutDate)->format('M d, Y') }}</span>
                </span>
                <span id="nights" class="text-gray-400 text-xl xl:text-2xl font-semibold inline-block">&nbsp;</span>
            </h1>
        </div>
    </div>
    <div class="flex content-center justify-between sm:grow">
        <div class="flex items-center me-4">
            <svg class="w-5 h-5 text-gray-800 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
            </svg>
            <h1 class="text-gray-900 text-md xl:text-xl font-semibold">
                <span id="selected-guest-count">{{ $numberOfGuests }}</span> {{ $numberOfGuests == 1 ? 'Guest' : 'Guests' }}
            </h1>
        </div>
        <button class="text-gray-600 mx-4 border-b-2 hover:border-blue-400" type="button" data-drawer-target="drawer-top-search" data-drawer-show="drawer-top-search" data-drawer-placement="top" data-drawer-body-scrolling="true" aria-controls="drawer-top-search">
            {{ __('Edit Stay') }}
        </button>
    </div>
</div>

