<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $faker = Faker::create('id_ID');

        // for ($i = 1; $i <= 5; $i++) {
        //     Mahasiswa::create([
        //         'nim' => $faker->numerify('19######'),
        //         'nama' => $faker->firstName() . " " . $faker->lastName(),
        //         'tanggal_lahir' => $faker->dateTimeInInterval('-4 years'),
        //         'ipk' => $faker->randomFloat(2, 1, 4)
        //     ]);
        // }

        // User::create([
        //     'name' => $faker->firstName(),
        //     'email' => $faker->email(),
        //     'password' => 'qwerty'
        // ]);

        // Khusus untuk proses mass assignment yang dilakukan dari seeder, kita tidak perlu menambah property $fillable atau $guarded ke dalam Model.

        // ! Memanggil semua seeder
        // $this->call(MahasiswaSeeder::class);
        // $this->call(UserSeeder::class);

        // menjalankan setelah di fresh
        // php artisan migrate:fresh --seed

        // ! Mengakses Factory dari Seeder
        // \App\Models\Mahasiswa::factory()->count(5)->create();
        // \App\Models\User::factory()->count(5)->create();
        // ? Ini juga dapat di jalankan di Tinker


        // ! Case Generating Data
        // $this->call(MatakuliahSeeder::class);


        // ! Data Mahasiswa
        \App\Models\DataMahasiswa::factory()->count(20)->create();
    }
}