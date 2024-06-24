<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = now()->addHours(rand(24, 240));

        return [
            'name' => fake()->sentence,
            'description' => fake()->paragraph,
            'venue_id' => Venue::factory(),
            'date_start' => $date,
            'date_end' => $date->addHours(rand(24, 240)),
            'poster' => fake()->imageUrl(),
            'media' => value(function () {
                return [
                    fake()->imageUrl(),
                    fake()->imageUrl(),
                    fake()->imageUrl(),
                ];
            }),
        ];
    }
}
