<?php

namespace Database\Seeders;

use App\Models\PlateCategory;
use Illuminate\Database\Seeder;

class PlateCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Entradas', 'description' => 'Platos para empezar'],
            ['name' => 'Sopas', 'description' => 'Caldos y sopas'],
            ['name' => 'Platos Principales', 'description' => 'Platos fuertes'],
            ['name' => 'Postres', 'description' => 'Dulces y postres'],
            ['name' => 'Bebidas', 'description' => 'Bebidas y refrescos'],
        ];

        foreach ($categories as $category) {
            PlateCategory::create($category);
        }
    }
}
