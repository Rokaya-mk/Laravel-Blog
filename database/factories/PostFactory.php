<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->realText(30);
        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'content' => $this->faker->text(100),
            'active'  => $this->faker->boolean()

        ];
    }
}
