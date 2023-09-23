<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['started', 'completed'];
        $countries = ['uk', 'usa', 'canada', 'asia', 'middle_east'];
        return [
            'title' => fake()->title(),
            'salary' => fake()->numberBetween(1000, 1500),
            'days' => 'Mon - Fri',
            'timing' => '10:00am - 6:00pm',
            'requirements' => ['Voluptates dolore la', ' Et tenetur ut recusa', 'Nobis est qui modi'],
            'status' => $status[array_rand($status)],
            'country' => $countries[array_rand($countries)],
        ];
    }
}
