<div id="accordion-{{ $id }}" data-accordion="collapse" data-active-classes="bg-blue-700" class="group bg-blue-800 has-[:checked]:bg-blue-600">
  <h2 id="accordion-{{ $id }}-heading">
    <button type="button" class="flex items-center justify-between w-full p-5 font-semibold text-white uppercase tracking-widest font-medium rtl:text-right hover:bg-blue-600 gap-3" data-accordion-target="#accordion-{{ $id }}-body" aria-expanded="false" aria-controls="accordion-{{ $id }}-body">
      <span class="group-has-[:checked]:hidden">{{ $slot }}</span>
      <span class="hidden group-has-[:checked]:block">Room Selected</span>
      <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
      </svg>
    </button>
  </h2>
  <div id="accordion-{{ $id }}-body" class="hidden" aria-labelledby="accordion-{{ $id }}-heading">
    <div class="">
      @foreach($rooms as $room)
        <div class="divide-y group/radio">
          @if($reservedRoomId == $room->id)
          <input type="radio" id="{{ $room->id }}" name="room_id" value="{{ $room->id }}" class="hidden peer" required checked />
          @else
          <input type="radio" id="{{ $room->id }}" name="room_id" value="{{ $room->id }}" class="hidden peer" required />
          @endif
          <label for="{{ $room->id }}" class="inline-flex items-center justify-between w-full p-5 text-gray-600 bg-white cursor-pointer peer-checked:bg-gray-300 peer-checked:text-gray-800 hover:text-gray-800 hover:bg-gray-100">
              <div class="block">
                  <div class="w-full text-lg font-semibold">#{{ $room->room_number }}</div>
              </div>
              <div>
                <x-primary-button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal" type="button" class="hidden group-has-[:checked]/radio:block">
                  {{ $reservedRoomId ? __('Confirm Changes') : __('Book Now') }}
                </x-primary-button>
              </div>
          </label>
        </div>
      @endforeach
    </div>
  </div>
</div>
