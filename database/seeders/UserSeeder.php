<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
             'name' => 'Fadil',
             'email' => 'fadil@gmail.com',
             'password' => Hash::make('123456'),   
            ]
            );
        User::factory(10)->create();
    }
}
