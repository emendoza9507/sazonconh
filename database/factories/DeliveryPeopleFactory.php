<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryPeopleFactory extends Factory
{
    public function definition(): array
    {
        $vehicleTypes = ['motorcycle', 'bicycle', 'car'];
        $brands = ['Honda', 'Yamaha', 'Suzuki', 'Toyota', 'Nissan'];

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'is_active' => $this->faker->boolean(80),
            'image' => 'delivery-people/' . $this->faker->image('public/storage/delivery-people', 400, 400, null, false),
            'vehicle_registration' => strtoupper($this->faker->lexify('???###')),
            'vehicle_type' => $this->faker->randomElement($vehicleTypes),
            'vehicle_plate' => strtoupper($this->faker->bothify('???-###')),
            'vehicle_color' => $this->faker->safeColorName(),
            'vehicle_brand' => $this->faker->randomElement($brands),
            'vehicle_model' => $this->faker->word(),
            'vehicle_year' => $this->faker->numberBetween(2015, 2024),
            'vehicle_image' => 'vehicles/' . $this->faker->image('public/storage/vehicles', 400, 400, null, false),
        ];
    }
}
