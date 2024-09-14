<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \FormBuilder\User\Models\User::create([
            'first_name' => 'Stefan',
            'last_name' => 'Wijmans',
            'email' => 'stefanwijmans@gmail.com',
            'password' => 'test1234',
        ]);
    }
}
