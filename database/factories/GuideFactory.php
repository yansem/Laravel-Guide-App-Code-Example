<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->unique()->word(),
            'program_link' => fake()->unique()->url(),
            'doc_link' => 'http://onlyoffice.orlan.in/' . fake()->unique()->slug(),
            'sort' => fake()->unique()->numberBetween(1,10),
            'approved' => rand(0, 1),
            'public' => rand(0, 1)
        ];
    }
}
