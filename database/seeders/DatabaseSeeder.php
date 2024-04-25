<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();

        $roomTypes = [];
        foreach (file(__DIR__ . '\roomTypes.txt') as $line) {
            list($roomType, $pricePerNight, $capacity) = explode(',', trim($line));
            $roomTypes[] = ['room_type' => $roomType, 'price_per_night' => floatval($pricePerNight), 'capacity' => (int)$capacity];
        }
        
        foreach ($roomTypes as $roomType) {
            \App\Models\RoomType::factory()->create($roomType);
        }

        $roomNumbers = [];
        foreach (file(__DIR__ . '\rooms.txt') as $line) {
            $roomNumbers[] = trim($line);
        }

        foreach ($roomNumbers as $roomNumber) {
            \App\Models\Room::factory()->create(['room_number' => $roomNumber]);
        }

        \App\Models\Reservation::factory(10)->create();
    }
}
