<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        User::query()->delete();

        User::query()->insert([
            'name' => 'Adrián',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 0
        ]);

        User::query()->insert([
            'name' => 'Adrián',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 1
        ]);
    }
}
