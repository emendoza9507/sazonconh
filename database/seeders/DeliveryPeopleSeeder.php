<?php

namespace Database\Seeders;

use App\Models\DeliveryPeople;
use Illuminate\Database\Seeder;

class DeliveryPeopleSeeder extends Seeder
{
    public function run(): void
    {
        DeliveryPeople::factory()
            ->count(20)
            ->create();
    }
}
