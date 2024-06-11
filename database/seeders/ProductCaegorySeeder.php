<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCaegorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('product_categories')->insert([
            [
                'id' => 1,
                'product_category_name' => 'None',
                'product_category_slug' => Str::slug('None'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_category_name' => 'Lighting and Accessories',
                'product_category_slug' => Str::slug('Lighting and Accessories'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_category_name' => 'Microphones',
                'product_category_slug' => Str::slug('Microphones'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'product_category_name' => 'Microphone stand and desk setup stand',
                'product_category_slug' => Str::slug('Microphone stand and desk setup stand'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'product_category_name' => 'Tripods & Selfie Sticks',
                'product_category_slug' => Str::slug('Tripods & Selfie Sticks'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'product_category_name' => 'Stabilizers',
                'product_category_slug' => Str::slug('Stabilizers'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'product_category_name' => 'Product Photography Accessories',
                'product_category_slug' => Str::slug('Product Photography Accessories'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'product_category_name' => 'Gopro & Accessories',
                'product_category_slug' => Str::slug('Gopro & Accessories'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'product_category_name' => 'Sound Products',
                'product_category_slug' => Str::slug('Sound Products'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'product_category_name' => 'IT Gadget',
                'product_category_slug' => Str::slug('IT Gadget'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'product_category_name' => 'CCTV',
                'product_category_slug' => Str::slug('CCTV'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
