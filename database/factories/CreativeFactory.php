<?php

namespace Database\Factories;

use App\Models\Creative;
use App\Models\CreativeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Creative>
 */
class CreativeFactory extends Factory
{
    protected $model = Creative::class;

    public function definition()
    {
        return [
            'creative_type_id' => CreativeType::factory(), // Assumes CreativeType factory exists
            'image' => $this->faker->randomElement([
                json_encode(['image1.jpg', 'image2.jpg']),
                json_encode(['image3.jpg', 'image4.jpg'])
            ]),
            'video' => $this->faker->randomElement([
                json_encode(['video1.mp4', 'video2.mp4']),
                json_encode(['video3.mp4'])
            ]),
            'content' => $this->faker->sentence(),
            'cta_name' => $this->faker->word(),
            'cta_url' => $this->faker->url(),
            'creative_name' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
