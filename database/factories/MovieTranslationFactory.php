<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieTranslation>
 */
class MovieTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>$this->faker->text(20),
            'language' =>$this->faker->randomElement(['en','fa','fr','ar','au','ue','es','it','ro','ge','du']),
            'release_year' =>$this->faker->year(),
            'poster' =>$this->faker->imageUrl(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
