<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Red',
            'Blue',
           'Green',
           'Yellow',
           'Black',
           'White',
           'Purple'
        ];

        foreach ($colors as $color) {
            DB::table('product_colors')->insert([
                'color_name' => ucfirst($color),
                'color_slug' => Str::slug($color),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
