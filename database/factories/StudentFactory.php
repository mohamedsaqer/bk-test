<?php

namespace Database\Factories;

use App\Models\School;
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
    public function definition()
    {
        $school_id = School::factory()->createOne()->id;

        return [
            'name' => $this->faker->name(),
            'school_id' => $school_id,
            'order' => Student::where('school_id', $school_id)->count() + 1,
        ];
    }
}
