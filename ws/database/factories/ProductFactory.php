<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3,false),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->text,
            'price'=>$this->faker->numberBetween(10,2)
        ];
    }
}
