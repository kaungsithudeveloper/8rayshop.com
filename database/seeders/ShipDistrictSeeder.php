<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = DB::table('ship_divisions')->get()->keyBy('division_name');

        $districts = [
            // Yangon Districts
            ['division_id' => $divisions['Yangon']->id, 'district_name' => 'East Yangon'],
            ['division_id' => $divisions['Yangon']->id, 'district_name' => 'North Yangon'],
            ['division_id' => $divisions['Yangon']->id, 'district_name' => 'South Yangon'],
            ['division_id' => $divisions['Yangon']->id, 'district_name' => 'West Yangon'],

            // Ayeyarwady Districts
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Pathein'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Kyonpyaw'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Hinthada'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Labutta'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Maubin'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Myanaung'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Myaungmya'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_name' => 'Pyapon'],
        ];

        DB::table('ship_districts')->insert($districts);
    }
}
