<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserGenre>
 */
class UserGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = Genre::all()->pluck('id')->toArray();
        return [
            'genre_id' => $this->faker->unique(true)->randomElement($genres)
        ];
    }
}
