<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(90),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'images' => array_map(
                fn() => 'menus/' . $this->faker->image('public/storage/menus', 400, 400, null, false),
                range(1, 3)
            ),
            'cover_image' => 'menus/covers/' . $this->faker->image('public/storage/menus/covers', 800, 400, null, false),
        ];
    }
}
