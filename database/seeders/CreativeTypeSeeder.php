<?php

namespace Database\Seeders;

use App\Models\CreativeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreativeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CreativeType::factory()->count(12)->create();
        $names = [
            'Carousel',
            'Scratch',
            'Video Canvas',
            'Video with Image Carousel',
            'Video with Image Slider',
            'Interactive Image Slider',
            'Image Hover Animation',
            'Hit to Unveil',
            'Pop & Reveal',
            'Scratch to Reveal',
            '3D Rotating Animation',
            'Expandable Images',
            'Image With Countdown',
            'Scratch To Reveal Video',
            'Video & Image Expand On Hover',
            'Products Slider',
            'Location Based Ads',
            'Responsive 3D Cube',
            'Stories Ads',
            'Creative Swiper',
            'Creative Image Animation',
            'Facebook',
            'Google',
            'Playable Game',
        ];

        // Insert each name into the database (replace 'creatives' with your actual table name)
        foreach ($names as $name) {
            DB::table('creative_types')->insert([
                'name' => $name,
                // Add other fields if necessary
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
