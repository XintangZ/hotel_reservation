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

        return [
            'user_id'=>$this->faker->randomElement($userIds),
            'room_id'=>$this->faker->randomElement($roomIds),
            'check_in_date' => $this->faker->dateTimeThisYear('+4 months'),
            'check_out_date' => function (array $attributes) {
                $checkInDate = $attributes['check_in_date'];
                $daysToAdd = $this->faker->numberBetween(1, 15);
                $upperLimitDate = Carbon::parse($checkInDate)->addDays($daysToAdd);

                return $this->faker->dateTimeBetween($checkInDate, $upperLimitDate);
            },
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
