<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\jenis>
 */
class JenisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis' => fake()->unique()->randomElement([
                'MAKANAN',
                'MINUMAN',
                'SNACK'
            ])
        ];
    }
}
