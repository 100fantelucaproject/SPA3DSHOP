<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(400),
            'price' => $this->faker->randomNumber(5, false),
            'category_id' => $this->faker->numberBetween(1,6),
            'user_id' => $this->faker->numberBetween(1,20),
        ];
    }
}
