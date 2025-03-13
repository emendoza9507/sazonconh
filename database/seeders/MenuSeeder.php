<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Plate;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $plates = Plate::all();

        Menu::factory()
            ->count(10)
            ->create()
            ->each(function ($menu) use ($plates) {
                $menu->plates()->attach(
                    $plates->random(rand(4, 8))->pluck('id')->toArray(),
                    ['quantity' => rand(1, 3)]
                );
            });
    }
}
