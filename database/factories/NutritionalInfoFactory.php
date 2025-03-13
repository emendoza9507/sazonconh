<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionalInfoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ingredient_id' => Ingredient::factory(),
            'calories' => $this->faker->numberBetween(50, 800),
            'protein' => $this->faker->randomFloat(2, 0, 50),
            'carbs' => $this->faker->randomFloat(2, 0, 100),
            'fat' => $this->faker->randomFloat(2, 0, 50),
            'fiber' => $this->faker->randomFloat(2, 0, 15),
            'sugar' => $this->faker->randomFloat(2, 0, 30),
            'sodium' => $this->faker->randomFloat(2, 0, 2000),
            'cholesterol' => $this->faker->randomFloat(2, 0, 100),
            'others' => [
                'vitamin_a' => $this->faker->randomFloat(2, 0, 100),
                'vitamin_c' => $this->faker->randomFloat(2, 0, 100),
                'calcium' => $this->faker->randomFloat(2, 0, 100),
                'iron' => $this->faker->randomFloat(2, 0, 100),
            ],
        ];
    }
}
