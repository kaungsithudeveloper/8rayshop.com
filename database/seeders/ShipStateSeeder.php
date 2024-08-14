<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = DB::table('ship_divisions')->get()->keyBy('division_name');
        $districts = DB::table('ship_districts')->get()->keyBy('district_name');

        $states = [
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Botataung '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Dagon Seikkan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'East Dagon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'North Dagon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'North Okkalapa '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Pazundaung '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'South Dagon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'South Okkalapa '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Thingangyun '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Dawbon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Mingala Taungnyunt '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Tamwe '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Thaketa '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['East Yangon']->id, 'state_name' => 'Yankin '],

            // Yangon: North Yangon District
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Hlaingthaya '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Insein '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Mingaladon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Shwepyitha '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Hlegu '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Hmawbi '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Htantabin '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['North Yangon']->id, 'state_name' => 'Taikkyi '],

            // Yangon: South Yangon District
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Dala '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Seikkyi Kanaungto '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Cocokyun '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Kawhmu '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Kayan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Kungyangon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Kyauktan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Thanlyin '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Thongwa '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['South Yangon']->id, 'state_name' => 'Twante '],

            // Yangon: West Yangon District
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Ahlon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Bahan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Dagon '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Kyauktada '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Kyimyindaing '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Lanmadaw '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Latha '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Pabedan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Sanchaung '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Seikkan '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Hlaing '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Kamayut '],
            ['division_id' => $divisions['Yangon']->id, 'district_id' => $districts['West Yangon']->id, 'state_name' => 'Mayangon '],

            // Ayeyarwady: Pathein District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Kangyidaunt'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Ngapudaw'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Hainggyikyun'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Ngayokaung'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Pathein'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Ngwesaung'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Chaung Thar'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Shwethaungyan'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pathein']->id, 'state_name' => 'Thabaung'],

            // Ayeyarwady: Kyonpyaw District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Kyonpyaw']->id, 'state_name' => 'Kyaunggon'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Kyonpyaw']->id, 'state_name' => 'Kyonpyaw'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Kyonpyaw']->id, 'state_name' => 'Yekyi'],

            // Ayeyarwady: Hinthada District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Hinthada']->id, 'state_name' => 'Hinthada'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Hinthada']->id, 'state_name' => 'Lemyethna'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Hinthada']->id, 'state_name' => 'Zalun'],

            // Ayeyarwady: Labutta District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Labutta']->id, 'state_name' => 'Labutta'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Labutta']->id, 'state_name' => 'Pyinsalu'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Labutta']->id, 'state_name' => 'Mawlamyinegyun'],

            // Ayeyarwady: Maubin District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Maubin']->id, 'state_name' => 'Danubyu'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Maubin']->id, 'state_name' => 'Maubin'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Maubin']->id, 'state_name' => 'Nyaungdon'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Maubin']->id, 'state_name' => 'Pantanaw'],

            // Ayeyarwady: Myanaung District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myanaung']->id, 'state_name' => 'Ingapu'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myanaung']->id, 'state_name' => 'Kyangin'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myanaung']->id, 'state_name' => 'Myanaung'],

            // Ayeyarwady: Myaungmya District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myaungmya']->id, 'state_name' => 'Einme'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myaungmya']->id, 'state_name' => 'Myaungmya'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Myaungmya']->id, 'state_name' => 'Wakema'],

            // Ayeyarwady: Pyapon District
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pyapon']->id, 'state_name' => 'Bogale'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pyapon']->id, 'state_name' => 'Dedaye'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pyapon']->id, 'state_name' => 'Kyaiklat'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pyapon']->id, 'state_name' => 'Pyapon'],
            ['division_id' => $divisions['Ayeyarwady']->id, 'district_id' => $districts['Pyapon']->id, 'state_name' => 'Ahmar'],
        ];

        DB::table('ship_states')->insert($states);
    }
}
