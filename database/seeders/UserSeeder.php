<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak admin account
        $admin = new User();
        $admin->name = 'Admin User';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password'); // Gebruik altijd bcrypt()!
        $admin->role = 'admin';
        $admin->save();

        // Maak gewone gebruiker
        $user = new User();
        $user->name = 'Regular User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('password');
        $user->role = 'user';
        $user->save();
    }
}
