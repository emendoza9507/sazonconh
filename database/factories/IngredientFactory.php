<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'image' => 'ingredients/' . $this->faker->image('public/storage/ingredients', 400, 400, null, false),
            'is_active' => $this->faker->boolean(90),
            'price' => $this->faker->randomFloat(2, 0.5, 50),
        ];
    }
}
