<?php

namespace Database\Factories;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bike_id' => Bike::factory(),
            'start_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_time' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
            'cost' => $this->faker->randomFloat(2, 5, 50),
            'status' => $this->faker->randomElement(['active', 'completed']),
        ];
    }
}
