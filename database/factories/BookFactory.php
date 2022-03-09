<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Author;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id'   => Author::factory(),
            'title'       => $this->faker->word(),
            'price'       => $this->faker->numberBetween($min = 0, $max = 1000),
            'image'  => $this->faker->imageUrl($width = 100, $height = 100),
            'description' => $this->faker->sentence(),
        ];
    }
}
