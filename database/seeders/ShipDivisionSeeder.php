<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['division_name' => 'Yangon'],
            ['division_name' => 'Ayeyarwady'],
            ['division_name' => 'Bago'],
            ['division_name' => 'Chin'],
            ['division_name' => 'Kachin'],
            ['division_name' => 'Kayah'],
            ['division_name' => 'Kayin'],
            ['division_name' => 'Magway'],
            ['division_name' => 'Mandalay'],
            ['division_name' => 'Mon'],
            ['division_name' => 'Naypyidaw'],
            ['division_name' => 'Rakhine'],
            ['division_name' => 'Sagaing'],
            ['division_name' => 'Shan'],
            ['division_name' => 'Tanintharyi'],
        ];

        DB::table('ship_divisions')->insert($divisions);
    }
}
