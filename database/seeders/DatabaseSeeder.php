<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Mostafa Super Admin',
            'email' => 'mghareeb841@gmail.com',
            'password' => bcrypt('Mostaf@2003'),
        ]);
        $user->assignRole('super_admin');
    }
}
