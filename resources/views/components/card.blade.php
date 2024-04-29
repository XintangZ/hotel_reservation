<div class="flex flex-col items-center md:flex-row w-full">
    <img class="object-cover w-full h-90 md:h-auto md:w-2/5 xl:w-1/3" src="/img/room-type-{{ $roomType->id }}.jpg" alt="{{ $roomType->room_type }}">
    <div class="flex w-full">
        <div class="flex flex-col justify-between p-4 leading-normal w-full">
            <div class="flex justify-between mb-2 md:mb-4 lg:mb-8">
                <div class="flex flex-col-reverse">
                    <h5 class="text-2xl lg:text-3xl font-bold tracking-tight text-gray-900 px-4 order-2">{{ $roomType->room_type }}</h5>
                    <p class="px-4 font-normal text-md text-gray-700 order-1">
                        Sleeps {{ $roomType->capacity }}
                    </p>
                </div>
                <div class="p-4 text-2xl lg:text-3xl font-bold text-center">
                    C${{ $roomType->price_per_night }}
                </div>
            </div>
            <p class="mb-3 text-lg text-gray-700 px-4">
                {{ $roomType->description }}
            </p>
        </div>
    </div>
</div>
