<?php

namespace Database\Factories;

use App\Models\PlateCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'category_id' => PlateCategory::factory(),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(90),
            'price' => $this->faker->randomFloat(2, 5, 150),
            'images' => array_map(
                fn() => 'plates/' . $this->faker->image('public/storage/plates', 400, 400, null, false),
                range(1, 4)
            ),
            'cover_image' => 'plates/covers/' . $this->faker->image('public/storage/plates/covers', 800, 400, null, false),
        ];
    }
}
