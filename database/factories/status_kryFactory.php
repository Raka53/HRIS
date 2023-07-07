<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\status_kry>
 */
class status_kryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $status = ['tetap', 'probahation', 'resign'];
        return [
            'status' => $this->faker->randomElement($status),
        ];
    }
}
