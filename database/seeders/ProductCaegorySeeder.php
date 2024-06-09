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
        $categories = [
            'none',
            'Lighting and Accessories',
            'Microphones',
            'Microphone stand and desk setup stand',
            'Tripods & Selfie Sticks',
            'Stabilizers',
            'Product Photography Accessories',
            'Gopro & Accessories',
            'Sound Products',
            'IT Gadget',
            'CCTV',
        ];


        foreach ($categories as $category) {
            DB::table('product_categories')->insert([
                'product_category_name' => $category,
                'product_category_slug' => Str::slug($category, '-'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
