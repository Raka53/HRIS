<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\hrd>
 */
class HrdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['Male','Female'];
        $department = ['IT', 'Finance', 'Marketing', 'Sales', 'Technik', 'Office'];
        $jobtitle = ['manager','staf'];
        $status = ['Probahation', 'tetap'];
        return [
            'NIK' => fake()->nik(),
            'name' => fake()->name(),
            'gender' => $gender[rand(0,1)],
            'joindate' => fake()->date(),
            'location' => fake()->city,
            'department' => $department[rand(0,5)],
            
            'joblevel' => fake()->jobTitle(),
            'jobtitle' => $jobtitle[rand(0,1)],
            'status' => $status[rand(0,1)]
            
        ];
    }
}
