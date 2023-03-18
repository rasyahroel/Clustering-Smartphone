<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = Student::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(3),
            'sch_name' => fake()->company(),
            'user_id' => mt_rand(1,6),
            'class' => fake()->jobTitle(),
            'gender' => fake()->randomElement(['L','P']),
            'age' => fake()->numberBetween(15,18),
            'category_id' => mt_rand(1,3)
        ];
    }
}
