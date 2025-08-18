<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameType>
 */
class GameTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => fake()->unique()->randomElement([
                'Basketball', 'Road Madness', 'Jet Packescape', 'Jump in gsnail'
            ]),
        ];
    }
}
