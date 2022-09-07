<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fio' => fake()->name(),
            'company' => fake()->company(),
            'number' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'birthday' => fake()->date(),
            'picture' => fake()->imageUrl()
        ];
    }
}
