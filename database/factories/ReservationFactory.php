<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $userIds = \App\Models\User::pluck('id')->toArray();
        $roomIds = \App\Models\Room::pluck('id')->toArray();

        $checkInDate = $this->faker->dateTimeThisYear('+2 months');
        $checkOutDate = Carbon::parse($checkInDate)->addDays($this->faker->numberBetween(2, 15));

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'room_id' => function (array $attributes) use ($roomIds, $checkInDate, $checkOutDate) {
                $existingReservations = \App\Models\Reservation::where('check_in_date', '<=', $checkOutDate)
                    ->where('check_out_date', '>=', $checkInDate)
                    ->pluck('room_id')
                    ->toArray();
    
                $availableRoomIds = array_diff($roomIds, $existingReservations);
                return $this->faker->randomElement($availableRoomIds);
            },
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'number_of_guests' => function (array $attributes) {
                $room = \App\Models\Room::find($attributes['room_id']);
                if ($room) {
                    $roomCapacity = $room->roomType->capacity;
                    return $this->faker->numberBetween(1, $roomCapacity);
                } else {
                    return 1; 
                }
            }
        ];
    }
}
