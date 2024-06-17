<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('product_sub_categories')->insert([
            [
                'id' => 1,
                'product_subcategory_name' => 'None',
                'product_subcategory_slug' => Str::slug('None'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id' => 2,
                'product_subcategory_name' => 'Gopro Hero 11',
                'product_subcategory_slug' => Str::slug('Gopro Hero 11'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_subcategory_name' => 'Gopro Hero 12',
                'product_subcategory_slug' => Str::slug('Gopro Hero 12'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id' => 4,
                'product_subcategory_name' => 'Gopro Hero 10',
                'product_subcategory_slug' => Str::slug('Gopro Hero 10'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'product_subcategory_name' => 'Gopro Hero 9',
                'product_subcategory_slug' => Str::slug('Gopro Hero 9'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'product_subcategory_name' => 'Gopro Hero 8',
                'product_subcategory_slug' => Str::slug('Gopro Hero 8'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'product_subcategory_name' => 'Gopro Hero 7',
                'product_subcategory_slug' => Str::slug('Gopro Hero 7'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'product_subcategory_name' => 'Gopro Hero 6',
                'product_subcategory_slug' => Str::slug('Gopro Hero 6'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'product_subcategory_name' => 'Gopro Hero 5',
                'product_subcategory_slug' => Str::slug('Gopro Hero 5'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'product_subcategory_name' => 'Earbuds',
                'product_subcategory_slug' => Str::slug('Earbuds'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'product_subcategory_name' => 'Headphone',
                'product_subcategory_slug' => Str::slug('Headphone'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'product_subcategory_name' => 'Speaker',
                'product_subcategory_slug' => Str::slug('Speaker'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'product_subcategory_name' => 'CCTV Camera',
                'product_subcategory_slug' => Str::slug('CCTV Camera'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'product_subcategory_name' => 'CCTV DVR & XVR',
                'product_subcategory_slug' => Str::slug('CCTV DVR & XVR'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'product_subcategory_name' => 'CCTV Accessories',
                'product_subcategory_slug' => Str::slug('CCTV Accessories'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('category_subcategory_belongs')->insert([
            [
                'product_category_id' => 1,
                'product_subcategory_id' => 1,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 2,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 3,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 4,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 5,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 6,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 7,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 8,
            ],
            [
                'product_category_id' => 8,
                'product_subcategory_id' => 9,
            ],
            [
                'product_category_id' => 9,
                'product_subcategory_id' => 10,
            ],
            [
                'product_category_id' => 9,
                'product_subcategory_id' => 11,
            ],
            [
                'product_category_id' => 9,
                'product_subcategory_id' => 12,
            ],
            [
                'product_category_id' => 11,
                'product_subcategory_id' => 13,
            ],
            [
                'product_category_id' => 11,
                'product_subcategory_id' => 14,
            ],
            [
                'product_category_id' => 11,
                'product_subcategory_id' => 15,
            ],
        ]);

    }
}
