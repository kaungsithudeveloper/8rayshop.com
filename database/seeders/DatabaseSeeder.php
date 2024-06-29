<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Price;
use App\Models\Stock;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserTableSeeder::class);
        $this->call([ProductTypeSeeder::class,]);
        $this->call([BrandSeeder::class,]);
        $this->call([ProductCaegorySeeder::class,]);
        $this->call([ProductSubCategorySeeder::class,]);
        $this->call([ProductColorSeeder::class,]);
        $this->call([BranchSeeder::class]);
        //$this->call([ProductSeeder::class]);

        \App\Models\User::factory(7)->create();


    }
}
