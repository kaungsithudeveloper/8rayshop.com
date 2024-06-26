<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_code' => 'P001',
                'product_name' => 'Product 1',
                'product_slug' => Str::slug('Product 1'),
                'product_photo' => 'product1.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P002',
                'product_name' => 'Product 2',
                'product_slug' => Str::slug('Product 2'),
                'product_photo' => 'product2.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P003',
                'product_name' => 'Product 3',
                'product_slug' => Str::slug('Product 3'),
                'product_photo' => 'product3.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P004',
                'product_name' => 'Product 4',
                'product_slug' => Str::slug('Product 4'),
                'product_photo' => 'product4.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P005',
                'product_name' => 'Product 5',
                'product_slug' => Str::slug('Product 5'),
                'product_photo' => 'product5.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P006',
                'product_name' => 'Product 6',
                'product_slug' => Str::slug('Product 6'),
                'product_photo' => 'product6.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'product_code' => 'P007',
                'product_name' => 'Product 7',
                'product_slug' => Str::slug('Product 7'),
                'product_photo' => 'product7.jpg',
                'status' => 'active',
                'user_id' => 1,
                'product_type_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        DB::table('product_brand_belongs')->insert([
            [
                'product_id' => 1,
                'brand_id' => 2,
            ],
            [
                'product_id' => 2,
                'brand_id' => 2,
            ],
            [
                'product_id' => 3,
                'brand_id' => 2,
            ],
            [
                'product_id' => 4,
                'brand_id' => 3,
            ],
            [
                'product_id' => 5,
                'brand_id' => 4,
            ],
            [
                'product_id' => 6,
                'brand_id' => 5,
            ],
            [
                'product_id' => 7,
                'brand_id' => 5,
            ],

        ]);

        DB::table('prices')->insert([
            [
                'product_id' => 1,
                'purchase_price' => '100.00',
                'selling_price' => '150.00',
                'discount_price' => '120.00',
            ],
            [
                'product_id' => 2,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],
            [
                'product_id' => 3,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],
            [
                'product_id' => 4,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],
            [
                'product_id' => 5,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],
            [
                'product_id' => 6,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],
            [
                'product_id' => 7,
                'purchase_price' => '200.00',
                'selling_price' => '250.00',
                'discount_price' => '220.00',
            ],

        ]);
    }
}
