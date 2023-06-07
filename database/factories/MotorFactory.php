<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['ready', 'sold']);
        return [
            'machine' => $this->faker->randomElement(['1200cc', '1500cc', '1800cc', '2000cc']),
            'suspension_type' => $this->faker->randomElement(['telescopic', 'upside down', 'mono shock', 'twin shock']),
            'transmission_type' => $this->faker->randomElement(['manual', 'automatic']),
            'status' => $status,
            'sold_date' => $status === 'ready' ? null : $this->faker->date(),
            'vehicle_id' => Vehicle::all()->random()->id,
        ];
    }
}
