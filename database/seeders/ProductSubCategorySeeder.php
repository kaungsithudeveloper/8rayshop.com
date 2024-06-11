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
        $subCategories = [
            ['category_name' => 'Gopro & Accessories', 'sub_categories' => [
                'Gopro Hero 12', 'Gopro Hero 11', 'Gopro Hero 10', 'Gopro Hero 9', 'Gopro Hero 8', 'Gopro Hero 7', 'Gopro Hero 6', 'Gopro Hero 5'
            ]],
            ['category_name' => 'Sound Products', 'sub_categories' => [
                'Earbuds', 'Headphone', 'Speaker'
            ]],
            ['category_name' => 'CCTV', 'sub_categories' => [
                'Camera', 'DVR & XVR', 'Accessories'
            ]],
        ];

        foreach ($subCategories as $categoryData) {
            $categoryId = DB::table('product_categories')->where('product_category_name', $categoryData['category_name'])->value('id');

            foreach ($categoryData['sub_categories'] as $subCategory) {
                DB::table('product_sub_categories')->insert([
                    'product_categories_id' => $categoryId,  // Update this line
                    'product_subcategory_name' => $subCategory,
                    'product_subcategory_slug' => Str::slug($subCategory),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
