<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataMahasiswa>
 */
class DataMahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->seed('407');
        return [
            'nim' => fake()->unique()->numerify('19######'),
            'nama' => fake('id_ID')->firstName() . " " . fake('id_ID')->lastName(),
            'tanggal_lahir' => fake()->dateTimeBetween('1990-01-01', '2003-01-01'),
            'ipk' => fake()->randomFloat(2, 2, 4),
            'created_at' => fake()->dateTimeBetween('-5 days'),
            'updated_at' => fake()->dateTimeBetween('-3 days')
        ];
    }
}