<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roomTypeIds = \App\Models\RoomType::pluck('id')->toArray();

        return [
            'id' => $this->faker->unique()->randomNumber(3),
            'room_type_id' => $this->faker->randomElement($roomTypeIds),
        ];
    }
}
