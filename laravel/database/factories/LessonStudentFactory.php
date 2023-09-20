<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonStudent>
 */
class LessonStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' =>  function () {
                return Lesson::inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::where('role', 'student')->inRandomOrder()->first()->id;
            },

        ];
    }
}
