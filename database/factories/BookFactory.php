<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => 'Autor - ' . fake()->numberBetween(1,  9999),
            'editora' => 'Editora - ' . fake()->numberBetween(1,  9999),
            'edicao'  => fake()->randomDigitNotNull(),
            'anopublicacao' => fake()->year(),
            'valor' => fake()->numberBetween(10, 999),
        ];
    }
}
