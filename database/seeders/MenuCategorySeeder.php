<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Menú del Día', 'description' => 'Especiales diarios'],
            ['name' => 'Menú Ejecutivo', 'description' => 'Para empresas'],
            ['name' => 'Menú Familiar', 'description' => 'Para compartir'],
            ['name' => 'Menú Festivo', 'description' => 'Para ocasiones especiales'],
        ];

        foreach ($categories as $category) {
            MenuCategory::create($category);
        }
    }
}
