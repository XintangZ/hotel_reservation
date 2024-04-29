<div class="flex flex-col items-center md:flex-row w-full">
    <img class="object-cover w-full h-96 md:h-auto md:w-48" src="/img/{{ strtolower($roomType->room_type) }}.jpg" alt="{{ strtolower($roomType->room_type) }}-room-interior">
    <div class="flex w-full">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $roomType->room_type }}</h5>
            <p class="mb-3 font-normal text-gray-700">
                Capacity: {{ $roomType->capacity }} {{ $roomType->capacity === 1 ? 'guest' : 'guests' }}
            </p>
        </div>
        <div class="p-4 text-3xl font-bold text-center">
            C${{ $roomType->price_per_night }}
        </div>
    </div>
</div>
