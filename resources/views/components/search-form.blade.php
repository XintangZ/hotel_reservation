@if(isset($disabled))
<div class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-12 gap-4">
@else
<form action="{{ route('room.search') }}" method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-12 gap-4" novalidate>
@endif
    <div class="xl:col-span-4">
        <x-input-label for="check_in_date" :value="__('Check-in Date')" />
        @if(isset($disabled))
        <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" value="{{ $checkInDate }}" :disabled="true" />
        @else
        <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" value="{{ $checkInDate ?? \Carbon\Carbon::tomorrow()->toDateString() }}" min="{{ \Carbon\Carbon::today()->toDateString() }}" />
        @endif
    </div>
    <div class="xl:col-span-4">
        <x-input-label for="check_out_date" :value="__('Check-out Date')" />
        @if(isset($disabled))
        <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" value="{{ $checkOutDate }}" :disabled="true" />
        @else
        <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" value="{{ $checkOutDate ?? \Carbon\Carbon::tomorrow()->addDays(1)->toDateString() }}" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" />
        @endif
    </div>
    <div class="xl:col-span-2">
        <x-input-label for="number_of_guests" :value="__('Number of Guests')" />
        @if(isset($disabled))
        <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" value="{{ $numberOfGuests }}" :disabled="true" />
        @else
        <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" value="{{ $numberOfGuests ?? 1 }}" min="1" max="4" />
        @endif
    </div>
    @if(isset($reservationId))
    <input type="hidden" name="reservation_id" value="{{ $reservationId }}">
    @endif
    <div class="flex flex-col-reverse xl:col-span-2">
        @if(isset($disabled))
        <x-primary-button class="h-[42px] mt-1 justify-center" type="button" data-drawer-target="drawer-top-search" data-drawer-show="drawer-top-search" data-drawer-placement="top" data-drawer-body-scrolling="true" aria-controls="drawer-top-search">
            {{ __('Edit Reservation Info') }}
        </x-primary-button>
        @else
        <x-primary-button class="h-[42px] mt-1 justify-center">{{ __('Check Availability') }}</x-primary-button>
        @endif
    </div>
@if(isset($disabled))
</div>
@else
</form>
@endif
