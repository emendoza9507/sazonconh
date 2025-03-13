<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Plate;
use Illuminate\Database\Seeder;

class PlateSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = Ingredient::all();

        Plate::factory()
            ->count(30)
            ->create()
            ->each(function ($plate) use ($ingredients) {
                $plate->ingredients()->attach(
                    $ingredients->random(rand(3, 8))->pluck('id')->toArray(),
                    ['quantity' => rand(1, 5)]
                );
            });
    }
}
