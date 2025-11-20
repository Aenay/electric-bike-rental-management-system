<?php

namespace Database\Factories;

use App\Models\Bike;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bike_id' => Bike::factory(),
            'issue' => $this->faker->sentence,
            'repair_date' => $this->faker->optional()->dateTimeThisMonth,
            'status' => $this->faker->randomElement(['open', 'in_progress', 'done']),
        ];
    }
}
