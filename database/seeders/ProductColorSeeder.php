<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['product_id' => 1, 'product_type_name' => 'Red'],
            ['product_id' => 2, 'product_type_name' => 'Blue'],
            ['product_id' => 3, 'product_type_name' => 'Green'],
            ['product_id' => 4, 'product_type_name' => 'Yellow'],
            ['product_id' => 5, 'product_type_name' => 'Black'],
            ['product_id' => 6, 'product_type_name' => 'White'],
            ['product_id' => 7, 'product_type_name' => 'Purple'],
        ];

        DB::table('product_colors')->insert($colors);
    }
}
