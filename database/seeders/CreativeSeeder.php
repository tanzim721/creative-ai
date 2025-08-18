<?php

namespace Database\Seeders;

use App\Models\Creative;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Generate 10 fake creatives
        Creative::factory()->count(1)->create();
    }
}
