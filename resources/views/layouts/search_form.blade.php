<form action="{{ route('reservation.create') }}" method="GET" class="row g-3" novalidate>
    <div class="col-6 col-md-3 col-xl-4">
        <x-input-label for="check_in_date" :value="__('Check-in Date')" />
        <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" :value="old('check_in_date')" min="{{ \Carbon\Carbon::today()->toDateString() }}" value="{{ \Carbon\Carbon::today()->addDays(1)->toDateString() }}" />
    </div>
    <div class="col-6 col-md-3 col-xl-4">
        <x-input-label for="check_out_date" :value="__('Check-out Date')" />
        <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" :value="old('check_out_date')" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" value="{{ \Carbon\Carbon::tomorrow()->addDays(1)->toDateString() }}"/>
    </div>
    <div class="col-6 col-md-3 col-xl-2">
        <x-input-label for="number_of_guests" :value="__('Number of Guests')" />
        <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" :value="old('number_of_guests')" value="1" min="1" max="4" />
    </div>
    <div class="col-6 col-md-3 col-xl-2 flex flex-col-reverse">
        <button type="submit" class="btn btn-primary mt-1 h-11">Check Availability</button>
    </div>
    <x-input-error class="mt-2" :messages="$errors->get('check_in_date')" />
    <x-input-error class="mt-2" :messages="$errors->get('check_out_date')" />
    <x-input-error class="mt-2" :messages="$errors->get('number_of_guests')" />
</form>