<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_at' => fake()->date(),
            'end_at' => fake()->date(),
            'label' => fake()->city,
            'room' => random_int(1,10),
            'signed_code' => false,
            'user_id' => function () {
                return User::where('role', 'teacher')->inRandomOrder()->first()->id;
            },
        ];

    }
    /*public function configure()
    {
        // Sélectionnez un ou plusieurs utilisateurs (students) à associer à la leçon
        $students = User::where('role', 'student')->inRandomOrder()->get();

        return $this->afterCreating(function (Lesson $lesson) use ($students) {
            // Attachez les utilisateurs (students) à la leçon dans la table pivot
            $lesson->students()->attach($students);
        });
    }
    */

}
