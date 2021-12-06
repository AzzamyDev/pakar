<?php

namespace Database\Seeders;

use App\Models\Psikolog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'psikolog']);
        Role::create(['name' => 'user']);
        $admin = User::create([
            'name' => 'Admin',
            'email' => env('EMAIL_ADMIN'),
            'no_telpon' => env('NOMER_ADMIN'),
            'password' => Hash::make(env('PASSWORD_ADMIN'))
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'angga@gmail.com',
            'no_telpon' => env('NOMER_ADMIN'),
            'password' => Hash::make('angga890')
        ]);

        $user->assignRole('user');

        $psikolog = User::create([
            'name' => 'Psikolog',
            'email' => 'psikolog@gmail.com',
            'no_telpon' => env('NOMER_ADMIN'),
            'password' => Hash::make('angga890')
        ]);

        $psikolog->assignRole('psikolog');
    }
}
