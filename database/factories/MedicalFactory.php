<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\medical>
 */
class MedicalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'hrd_id' => $this->faker->numberBetween(1, 50),
            'date_claim' => $this->faker->date,
            'date' => $this->faker->date,
            'patient' => $this->faker->name,
            'doctor_fee' => $this->faker->randomFloat(2, 100, 1000),
            'obat' => $this->faker->randomFloat(2, 50, 500),
            'kacamata' => $this->faker->randomFloat(2, 200, 1000),
            'total' => $this->faker->randomFloat(2, 500, 2000),
            'foto' => null, // Assuming the 'foto' field is optional
        ];
    }
}
