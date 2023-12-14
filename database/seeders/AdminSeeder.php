<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'profile_image' => null,
            'lname' => null,
            'fname' => 'Admin',
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'gender' => 'Male',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('coffee')
        ])->assignRole('Admin', 'User')
            ->givePermissionTo('manage-all', 'customer',);

        User::factory()->create([
            'profile_image' => null,
            'lname' => 'Abisado',
            'fname' => 'Janna',
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'gender' => 'Female',
            'email' => 'abisadojanna@gmail.com',
            'password' => bcrypt('coffee')
        ])->assignRole('User')
            ->givePermissionTo('customer');
    }
}
