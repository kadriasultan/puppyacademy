<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder voor users
        $this->call(UserSeeder::class);

        // Een test user


        // Seeder voor shop data
        $this->call([
            ShopSeeder::class,
        ]);
    }
}
