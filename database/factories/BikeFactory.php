<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bike>
 */
class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['Cruiser', 'Road', 'Mountain', 'Hybrid']),
            'status' => $this->faker->randomElement(['available', 'in_use', 'maintenance']),
            'station_id' => Station::factory(),
            'battery_level' => $this->faker->numberBetween(0, 100),
        ];
    }
}
