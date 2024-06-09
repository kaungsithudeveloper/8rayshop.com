<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(7)->create();
    }
}
