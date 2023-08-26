<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


// ! Factory
// Factory adalah suatu class di dalam Laravel yang dipakai untuk men-generate instance dari Model class. Instance ini berisi data yang seolah-olah berasal dari database. Misalnya kita memiliki model Mahasiswa, maka factory bisa dipakai untuk men-generate 1 data mahasiswa. Data mahasiswa tersebut tidak diambil dari database, tapi langsung di generate dari kode program. Nantinya data hasil factory juga bisa diinput ke dalam database yang berfungsi mirip seperti seeder.

class FactoryController extends Controller
{
    // ! Membuat File Factory
    // Dalam penerapannya, satu factory akan berpasangan dengan satu model. Misalnya model Mahasiswa akan berpasangan dengan "Mahasiswa Factory", begitu juga model User yang akan berpasangan dengan "User Factory"

    // Berikut format dasar perintah php artisan untuk membuat file factory:
    // php artisan make:factory <NamaFactory>

    // Nama file factory harus* memakai format <NamaModel>+"Factory". Misalnya jika ingin membuat factory untuk model Mahasiswa, maka nama file harus MahasiswaFactory. Atau factory untuk model User bisa ditulis sebagai UserFactory.


    // ! Untuk menjalankan Factory
    public function __invoke()
    {
        $mahasiswa = Mahasiswa::factory()->make();
        dump($mahasiswa);
    }

    public function mahasiswa()
    {
        $mahasiswa = Mahasiswa::factory()->make();

        echo $mahasiswa->nim . "<br>";
        echo $mahasiswa->nama . "<br>";
        echo Carbon::parse($mahasiswa->tanggal_lahir)->isoFormat('D-M-YYYY') . "<br>";
        echo $mahasiswa->ipk;
    }

    // count untuk menentukan berapaka kali data di generate(instance)
    public function mahasiswaArray()
    {
        $mahasiswa = Mahasiswa::factory()->count(5)->make();

        foreach ($mahasiswa as $mhs) {
            echo "<ul>
                <li>NIM: {$mhs->nim}</li>
                <li>Nama: {$mhs->nama}</li>
                <li>Tanggal Lahir: " .
                Carbon::parse($mhs->tanggal_lahir)->isoFormat('D-M-YYYY') .
                "</li>
                <li>IPK: {$mhs->ipk}</li>
            </ul>";
        }
    }

    // Kita juga bisa memodifikasi misal menambah atau menimpa nilai baru pada factory
    public function mahasiswaModif()
    {
        $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Kendaraan Ringan', 'Teknik Ototronik', 'Teknik Sepeda Motor', 'Agribisnis Pengolahan Hasil Pertanian'];

        $mahasiswa = Mahasiswa::factory(3)->make([
            'nama' => fake()->firstName() . " " . fake()->lastName(),
            'jurusan' => fake()->randomElements($jurusan)
        ]);

        foreach ($mahasiswa as $mhs) {
            echo "<ul>
                <li>NIM: {$mhs->nim}</li>
                <li>Nama: {$mhs->nama}</li>
                <li>Jurusan: {$mhs->jurusan[0]}</li>
                <li>Tanggal Lahir: " .
                Carbon::parse($mhs->tanggal_lahir)->isoFormat('D-M-YYYY') .
                "</li>
                <li>IPK: {$mhs->ipk}</li>
            </ul>";
        }
        // Karena saya timpa dan menambahkan maka data saat di generate akan sama semua
    }

    // ! Factory(Faker) Localization
    // bisa diganti di config app.php line 112 menjadi 'id_ID' untuk indonesia


    // ! Input Factory ke Database
    public function mahasiswaCreate()
    {
        Mahasiswa::factory()->create();
        return "Penambahan Data berhasil";
    }
    public function mahasiswaCreateMany($jumlah)
    {
        Mahasiswa::factory()->count($jumlah)->create();
        return "Penambahan {$jumlah} Data berhasil";
    }


    // ! Sekarang untuk User
    public function user()
    {
        $user = User::factory()->make();
        dump($user);
    }

    // ? Factory State
    // Factory states adalah method tambahan untuk memodifikasi hasil factory normal yang ada di method definition(). Maksudnya, jika method definition() terdapat perintah untuk mengisi kolom 'name' dengan $this->faker->name(), kita bisa timpa nilai tersebut menjadi $this- >faker->userName() atau nilai lain lewat factory states

    public function userState()
    {
        $user = User::factory()->unverified()->make();
        dump($user);
    }

    // ! Exercise
    public function mahasiswaExercise()
    {
        $mahasiswa = Mahasiswa::factory()->cumlaude()->make();
        dump($mahasiswa);
    }

    // Generate 10 data mahasiswa dan user
    public function mahasiswaUserCreated()
    {
        Mahasiswa::factory()->count(10)->create();
        User::factory()->count(10)->create();
        return "Berhasil generate 10 data Mahasiswa dan Users";
    }

    // Selanjutnya mengakses Factory dari Seeder, lihat di DatabaseSeeder.php

    // ! Shortcut untuk Generate File Factory
    // Umumnya file factory di buat bersamaan dengan file model, migration, seeder dan juga controller. Karena itulah Laravel menyediakan shortcut khusus untuk membuat kelima file ini sekaligus. Caranya, tambah flag -cmfs ke dalam perintah php artisan make:model seperti contoh berikut:
    // php artisan make:model Dosen -cmfs

    // Perintah di atas akan membuat 5 file:
    // 1. File model: app\Models\Dosen.php
    // 2. File factory: database\factories\DosenFactory.php
    // 3. File migration: database\migrations\<timestamp>create_dosens_table.php
    // 4. File seeder: database\seeders\DosenSeeder.php
    // 5. File controller: app\Http\Controllers\DosenController.php


    // Lebih jauh lagi, Laravel menyediakan flag --all untuk membuat file model, resource controller, migration, factory dan seeder:
    // php artisan make:model Karyawan --all
}