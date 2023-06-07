<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'machine' => $this->faker->randomElement(['1200cc', '1500cc', '1800cc', '2000cc']),
            'passenger_capacity' => $this->faker->numberBetween(2, 7),
            'type' => $this->faker->randomElement(['sedan', 'hatchback', 'suv', 'mpv']),
            'status' => $this->faker->randomElement(['ready', 'sold']),
            'sold_date' => $this->faker->randomElement([null, $this->faker->date()]),
            'vehicle_id' => Vehicle::all()->random()->id,
        ];
    }
}
