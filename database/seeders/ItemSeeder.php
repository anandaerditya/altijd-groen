<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'kg', 'name' => 'Kilogram', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'm', 'name' => 'Meter', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'lt', 'name' => 'Liter', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $arr) {
            DB::table('item_units')->insert($arr);
        }
    }
}
