<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address' => $this->faker->address(),
            'street_address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zip_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'references' => $this->faker->sentence(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'is_active' => $this->faker->boolean(80),
            'is_default' => $this->faker->boolean(20),
        ];
    }
}
