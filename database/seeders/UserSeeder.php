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

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->role = 'admin';
        $admin->save();

        $user = new User();
        $user->name = 'Regular User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('password');
        $user->role = 'user';
        $user->save();
    }
}
