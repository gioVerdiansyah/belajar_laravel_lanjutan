<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim' => fake()->unique()->numerify('19######'),
            'nama' => fake('id_ID')->firstName() . " " . fake('id_ID')->lastName(),
            'tanggal_lahir' => fake()->dateTimeInInterval('-4 years'),
            'ipk' => fake()->randomFloat(2, 2, 4)
        ];
    }

    public function cumlaude(): static
    {
        return $this->state(fn(array $attributes) => [
            'ipk' => fake()->randomFloat(2, 3.5, 4)
        ]);
    }
}