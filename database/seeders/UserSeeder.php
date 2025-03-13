<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@sazonconh.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => '999999999',
            'is_active' => true,
            'profile_photo_path' => null,
        ]);
        $admin->assignRole('admin');

        // Crear usuario gerente
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@sazonconh.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => '999999998',
            'is_active' => true,
            'profile_photo_path' => null,
        ]);
        $manager->assignRole('manager');

        // Crear 5 empleados
        User::factory()->count(5)->create()->each(function ($user) {
            $user->assignRole('employee');
        });

        // Crear 10 repartidores
        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('delivery');
            $user->deliveryPerson()->create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'is_active' => true,
                'vehicle_type' => 'motorcycle',
                'vehicle_plate' => 'ABC-' . rand(100, 999),
            ]);
        });

        // Crear 30 clientes
        User::factory()->count(30)->create()->each(function ($user) {
            $user->assignRole('customer');
        });
    }
}
