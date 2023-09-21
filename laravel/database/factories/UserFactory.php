<?php

namespace Database\Factories;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' =>  Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function teacher(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'teacher',
        ]);
    }
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'student',
            'classe_id' =>  function () {return Classe::all()->random()->id;}
        ]);
    }
}
