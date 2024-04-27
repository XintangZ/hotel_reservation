<form action="{{ route('reservation.create') }}" method="GET" class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-12 gap-4" novalidate>
    <div class="xl:col-span-4">
        <x-input-label for="check_in_date" :value="__('Check-in Date')" />
        <x-text-input type="date" name="check_in_date" id="check_in_date" class="mt-1 block w-full" value="{{ isset($params) ? $params['check_in_date'] : old('check_in_date', \Carbon\Carbon::tomorrow()->toDateString()) }}" min="{{ \Carbon\Carbon::today()->toDateString() }}" />
    </div>
    <div class="xl:col-span-4">
        <x-input-label for="check_out_date" :value="__('Check-out Date')" />
        <x-text-input type="date" name="check_out_date" id="check_out_date" class="mt-1 block w-full" value="{{ isset($params) ? $params['check_out_date'] : old('check_out_date', \Carbon\Carbon::tomorrow()->addDays(1)->toDateString()) }}" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" />
    </div>
    <div class="xl:col-span-2">
        <x-input-label for="number_of_guests" :value="__('Number of Guests')" />
        <x-text-input type="number" name="number_of_guests" id="number_of_guests" class="mt-1 block w-full" value="{{ isset($params) ? $params['number_of_guests'] : old('number_of_guests', 1) }}" min="1" max="4" />
    </div>
    <div class="flex flex-col-reverse xl:col-span-2">
        <x-primary-button class="h-[42px] mt-1 justify-center">{{ __('Check Availability') }}</x-primary-button>
    </div>
    @if($errors->any())
        @foreach ($errors->all() as $error)
        <x-input-error class="mt-2" :messages="$error" />
        @endforeach
    @endif
</form>