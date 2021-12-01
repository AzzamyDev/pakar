<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Admin',
            'email' => env('EMAIL_ADMIN'),
            'no_telpon' => env('NOMER_ADMIN'),
            'password' => Hash::make(env('PASSWORD_ADMIN'))
        ]);
    }
}
