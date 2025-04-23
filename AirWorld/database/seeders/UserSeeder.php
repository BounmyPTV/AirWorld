<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'surname' => 'test',
            'email' => 'test@example.com',
            'password' => Hash::make('1234'),
        ]);
    }
}