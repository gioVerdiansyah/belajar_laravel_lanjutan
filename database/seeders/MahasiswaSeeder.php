<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \Flynsarmy\CsvSeeder\CsvSeeder;


// File ini bisa digunakan jika kita membuat data dummy teruntuk Mahasiswa
// class MahasiswaSeeder extends Seeder
class MahasiswaSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=MahasiswaSeeder
     */

    // ? Untuk menjalankan data dari CSV
    public function __construct()
    {
        $this->table = 'mahasiswas';
        $this->filename = base_path() . '/database/seeders/csv/Mahasiswa - Sheet1.csv'; //alamat file CSV
        $this->should_trim = true; // menghapus tambahan spasi di awal dan akhir data
        $this->timestamps = true;
        $this->created_at = now();
        $this->updated_at = now();

        // Pengaturan lainnya ada di: https://github.com/Flynsarmy/laravel-csv-seeder
    }
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

        // ! Menjalankan data dari file CSV
        parent::run();
    }
}