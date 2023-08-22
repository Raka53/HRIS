<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\hrd>
 */
class HrdFactory extends Factory
{
    /**protected $model = Hrd::class;

     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition()
    {
        $gender = ['Male', 'Female'];
        $department = ['IT', 'Finance', 'Marketing', 'Sales', 'Technik', 'Office'];
        $jobtitle = ['Manager', 'Staff'];
        

        return [
            'NIK' => $this->faker->unique()->randomNumber(8), // Menghasilkan NIK acak dengan 8 digit
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement($gender),
            'joindate' => $this->faker->date,
            'location' => $this->faker->city,
            'department' => $this->faker->randomElement($department),
            'joblevel' => $this->faker->jobTitle,
            'jobtitle' => $this->faker->randomElement($jobtitle),
            'statusKry' => $this->faker->randomElement([1, 2, 3]),
            'foto' => null,
        ];
    
    }
}
