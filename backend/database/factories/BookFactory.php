<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'author' => fake()->words(2, true),
            'publisher' => fake()->words(2, true),
            'publish_date' => fake()->numberBetween(2000, 2040),
            'price' => fake()->numberBetween(80000, 100000),
            'stock' => fake()->numberBetween(50, 100)
        ];
    }
}
