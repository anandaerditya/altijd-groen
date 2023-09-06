<?php

namespace Database\Seeders;

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
        $data = [
            ['name' => 'User 1', 'username' => 'user_1', 'password' => Hash::make('user_1'), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User 2', 'username' => 'user_2', 'password' => Hash::make('user_2'), 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $arr) {
            DB::table('users')->insert($arr);
        }
    }
}
