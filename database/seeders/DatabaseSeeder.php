<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            PlateCategorySeeder::class,
            MenuCategorySeeder::class,
            IngredientSeeder::class,
            PlateSeeder::class,
            MenuSeeder::class,
            DeliveryPeopleSeeder::class,
            AddressSeeder::class,
        ]);
    }
}
