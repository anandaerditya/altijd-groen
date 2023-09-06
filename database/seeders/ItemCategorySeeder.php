<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'kts', 'name' => 'Kitchen Set', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'bds', 'name' => 'Bedroom Set', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'fms', 'name' => 'Family Room Set', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $arr) {
            DB::table('item_categories')->insert($arr);
        }
    }
}
