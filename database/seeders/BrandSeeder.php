<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'none', 'Telesin', 'Puluz', 'Digitkek', 'Shoot', 'Ulanzi', 'Gopro', 'Maono', 'Lilliput', 'Uniview',
            'Boya', 'Rode', 'Atem mini pro', 'Onten', 'Elgato', 'FoG Machine', 'Orico', 'Micropack',
            'Verbatim', 'Barmaso', 'Hik', 'Dahua', 'Imou', 'Hohem', 'Skullcandy', 'Aukey', 'Picun',
            'Tronsmart', 'Envie', 'Infinite', 'Kingma', 'Kimasing', 'Nanlite', 'Mars', 'Fantech', 'Ugreen',
            'Sun', 'Redragon', 'WGp', 'Ezviz', 'UNV', 'Botslab'
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'brand_name' => $brand,
                'brand_slug' => Str::slug($brand, '-'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
