<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'branch_name' => '8ray(Main)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_name' => '8ray(Gamont Phwint)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
