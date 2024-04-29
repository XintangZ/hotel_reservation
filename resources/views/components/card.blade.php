<div class="flex flex-col items-center md:flex-row w-full">
    <img class="object-cover w-full h-90 md:h-auto md:w-2/5 xl:w-1/3" src="/img/room-type-{{ $roomType->id }}.jpg" alt="{{ $roomType->room_type }}">
    <div class="flex w-full">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <div class="flex justify-between mb-2">
                <div class="flex flex-col-reverse py-4">
                    <h5 class="text-3xl font-bold tracking-tight text-gray-900 px-4">{{ $roomType->room_type }}</h5>
                </div>
                <div class="p-4 text-3xl font-bold text-center">
                    C${{ $roomType->price_per_night }}
                </div>
            </div>
            <p class="mb-3 px-4 font-normal text-lg text-gray-700">
                Sleeps {{ $roomType->capacity }}
            </p>
            <p class="mb-3 text-xl text-gray-700 px-4 text-justify">
                {{ $roomType->description }}
            </p>
        </div>
    </div>
</div>
