<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'room_type' => $this->faker->randomElement(['Single', 'Double', 'Triple', 'Quadruple']),
            'price_per_night' => $this->faker->numberBetween(100, 500),
            'capacity' => $this->faker->randomElement([1,2,3,4]),
        ];
    }
}
