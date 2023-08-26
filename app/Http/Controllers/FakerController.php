<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker;


// ! Faker
// Faker adalah library PHP untuk men-generate data dummy atau fake data. Faker bisa dipakai jika ingin membuat data awal atau data random sebagai bahan percobaan

class FakerController extends Controller
{
    public function instance()
    {
        $faker = Faker::create();
        dump($faker);
    }

    // menggunakan Faker
    public function fakerMethod()
    {
        $faker = Faker::create();

        echo $faker->name() . "<hr>";
        echo $faker->address() . "<hr>";
        echo $faker->text() . "<hr>";
    }

    public function fakerLoop(int $index = 10)
    {
        $faker = Faker::create();
        for ($i = 1; $i <= $index; $i++) {
            echo "{$i}. {$faker->name()} from {$faker->address()} <hr>";
        }
    }

    public function fakerLoopLang(string $lang = 'id_ID')
    {
        $faker = Faker::create($lang);
        for ($i = 1; $i <= 10; $i++) {
            echo "{$i}. {$faker->name()} from {$faker->address()} <hr>";
        }
    }

    // ! Faker Formatters
    // format lengkap berada di: https://fakerphp.github.io/formatters

    // ? Base Format
    // Disebut sebagai base karena terdiri dari format yang umum dipakai.
    public function fakerBase()
    {
        $faker = Faker::create('id_ID');

        echo $faker->name() . "<hr>";
        echo $faker->address() . "<hr>";
        echo $faker->company() . "<hr>";
        echo $faker->email() . "<hr>";
        echo $faker->date() . "<hr>";
        echo $faker->userName() . "<hr>";
        echo $faker->password() . "<hr>";
        echo $faker->url() . "<hr>";
    }

    // ? number Format
    // Number format dipakai untuk men-generate angka acak. Beberapa method bisa menerima argument untuk pengaturan lebih lanjut:

    public function fakerNumber()
    {
        $faker = Faker::create('id_ID');

        echo $faker->randomDigit() . "<hr>"; //random angka 0-9
        echo $faker->randomDigitNot(3) . "<hr>"; //random angka 0-9 kecuali 3
        echo $faker->randomDigitNotNull() . "<hr>"; //random angka 1-9
        echo $faker->randomNumber(3) . "<hr>"; //mengembalikan 3 angka acak
        echo $faker->randomFloat(2, 1.00, 4.00) . "<hr>";
        //mengembalikan angka pecahan 2 digit kebelakang dari 1-4
        echo $faker->numberBetween(10, 20) . "<hr>";
        //mengembalikan angka random dari angka 10 sampai 20
    }

    // ? Address Format
    public function fakerAddress()
    {
        $faker = Faker::create('id_ID');

        echo $faker->buildingNumber() . "<hr>";
        echo $faker->streetName() . "<hr>";
        echo $faker->streetAddress() . "<hr>";
        echo $faker->postcode() . "<hr>";
        echo $faker->city() . "<hr>";
        echo $faker->stateAbbr() . "<hr>";
        echo $faker->state() . "<hr>";
        echo $faker->address() . "<hr>";
        echo $faker->country() . "<hr>";
    }

    // ? Phone dan Company Format
    public function fakerPhone()
    {
        $faker = Faker::create('id_ID');

        echo $faker->phoneNumber() . "<hr>";
        echo $faker->e164PhoneNumber() . "<hr>";
        echo $faker->company() . "<hr>";
        echo $faker->companyEmail() . "<hr>";
        echo $faker->companySuffix() . "<hr>";
    }

    // ? Faker Internet
    public function fakerInternet()
    {
        $faker = Faker::create('id_ID');

        echo $faker->email() . "<hr>";
        echo $faker->safeEmail() . "<hr>";
        echo $faker->companyEmail() . "<hr>";
        echo $faker->freeEmailDomain() . "<hr>";
        echo $faker->safeEmailDomain() . "<hr>";
        echo $faker->username() . "<hr>";
        echo $faker->password() . "<hr>";
        echo $faker->domainName() . "<hr>";
        echo $faker->domainWord() . "<hr>";
        echo $faker->tld() . "<hr>";
        echo $faker->slug() . "<hr>";
        echo $faker->ipv4() . "<hr>";
        echo $faker->localIpv4() . "<hr>";
        echo $faker->ipv6() . "<hr>";
        echo $faker->macAddress() . "<hr>";
    }

    // ? Faker Date
    public function fakerDate()
    {
        $faker = Faker::create('id_ID');

        echo $faker->unixTime() . "<hr>";
        echo $faker->date() . "<hr>";
        echo $faker->date('d/m/Y') . "<hr>";
        echo $faker->date('d/m/Y', 'yesterday') . "<hr>";
        echo $faker->time() . "<hr>";
        echo $faker->dayOfWeek() . "<hr>";
        echo $faker->dayOfMonth() . "<hr>";
        echo $faker->month() . "<hr>";
        echo $faker->monthName() . "<hr>";
        echo $faker->year() . "<hr>";

        // meski sudah berfotmat ID namun untuk localization masih belum
    }

    public function fakerDateCarbon()
    {
        $faker = Faker::create('id_ID');
        $date_id = \Carbon\Carbon::createFromTimestamp($faker->unixTime());

        echo $date_id->dayName . "<hr>";
        echo $date_id->monthName . "<hr>";

        // Teknik yang saya pakai adalah men-generate angka unixTime() random dari Faker sebagai nilai input untuk Carbon melalui method createFromTimestamp(). Selanjutnya cukup akses property dayName dan monthName dari object carbon tersebut
    }

    public function fakerDateInterval()
    {
        $faker = Faker::create('id_ID');

        // Between
        print_r($faker->dateTimeBetween('-6 years'));
        echo "<hr>";
        print_r($faker->dateTimeBetween('-6 years', '+1 years'));
        echo "<hr>";
        print_r($faker->dateTimeBetween('2019-01-01', '2020-01-01'));
        echo "<hr>";
        print_r($faker->dateTimeBetween('2022-01-01', '2022-01-30'));
        echo "<hr>";

        // Interval
        print_r($faker->dateTimeInInterval('2022-01-01', '+2 months'));
        echo "<hr>";
        print_r($faker->dateTimeInInterval('2022-01-01', '-1 years'));
        echo "<hr>";

        print_r($faker->dateTimeThisCentury());
        echo "<hr>";
        print_r($faker->dateTimeThisDecade());
        echo "<hr>";
        print_r($faker->dateTimeThisYear());
        echo "<hr>";
        print_r($faker->dateTimeThisMonth());
        echo "<hr>";

        // Cara mengakses DateTIme object:
        echo $faker->dateTimeBetween('2021-01-01', '2022-01-01')->format('d M Y H:i:s');
    }

    // ! NIK faker
    // NIK Indonesia memiliki urutan sebagai berikut:
    // 2 digit kode provinsi + 2 digit kode kota/kabupaten+ 2 digit kode kecamatan + 6 digit tanggal lahir dalam format ddmmyy (untuk perempuan tanggal lahir di tambah 40) + 4 digit nomor urut yang dimulai dari 0001

    public function fakerNIK()
    {
        $faker = Faker::create('id_ID');

        echo $faker->nik() . "<hr>";
        echo $faker->nik('male') . "<hr>";
        echo $faker->nik('female') . "<hr>";

        // Penambahan tanggal lahir
        $tanggal_lahir = $faker->dateTimeBetween('1960-01-01', '2004-01-01');
        echo $faker->nik('male', $tanggal_lahir) . "<hr>";
        echo $faker->nik('female', $tanggal_lahir) . "<hr>";
    }

    // ! Faker Seed
    // Ketika menjalankan kode yang sama beberapa kali, Faker akan men-generate data random yang selalu berubah. Jika kita butuh data yang selalu konsisten, bisa menjalankan method $faker->seed() sebelum mengakses Faker format

    public function fakerSeed()
    {
        $faker = Faker::create('id_ID');
        $faker->seed(1020); //coba juga seed lain, ini angka random

        echo $faker->nik() . "<hr>";
        echo $faker->name() . "<hr>";
        echo $faker->address() . "<hr>";
        echo $faker->email() . "<hr>";
    }

    // ! Modifier
    // ? Unique
    // menghiindari agar tidak terjadi angka yang berulang

    public function fakerUniqueDigit()
    {
        $faker = Faker::create('id_ID');

        echo "Random Digit:  ";
        for ($i = 1; $i <= 10; $i++) {
            echo $faker->randomDigit() . " ";
        }

        echo "<hr> Unique Digit:  ";
        for ($i = 1; $i <= 10; $i++) {
            echo $faker->unique()->randomDigit() . " ";
        }

        // Jika kita membuat perulangan lebih dari 10 digit maka akan error, karena random digit hanya dapat menampung 10 digit angka saja
    }

    public function fakerRandomElement()
    {
        $faker = Faker::create('id_ID');

        $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Kendaraan Ringan', 'Teknik Ototronik', 'Teknik Sepeda Motor', 'Agribisnis Pengolahan Hasil Pertanian'];

        echo "Random Array: <br>";
        for ($i = 1; $i <= 10; $i++) {
            echo "{$i}.) {$faker->randomElement($jurusan)} <br>";
        }

        echo "<hr>Unique Array: <br>";
        for ($i = 1; $i <= count($jurusan); $i++) {
            echo "{$i}.) {$faker->unique()->randomElement($jurusan)} <br>";
        }
    }

    // ? Optional Modifier
    // mirip seperti sebelumnya namun ada value NULL sebagai optional

    public function fakerOptional()
    {
        $faker = Faker::create('id_ID');

        $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Kendaraan Ringan', 'Teknik Ototronik', 'Teknik Sepeda Motor', 'Agribisnis Pengolahan Hasil Pertanian'];

        echo "Faker Optional without parameters: <br>";
        for ($i = 1; $i <= 10; $i++) {
            var_dump($faker->optional()->randomElement($jurusan));
            echo "<br>";
        }

        echo "<hr>Faker Optional with parameters: <br>";
        for ($i = 1; $i <= 10; $i++) {
            var_dump($faker->optional(0.8, 'tidak memilih jurusan')->randomElement($jurusan));
            echo "<br>";
        }
        // parameter pertama adalah persentase muncul optionalnya, parameter kedua adalah nilainya
    }


    // ! Faker dan Eloquent
    public function fakerMahasiswa()
    {
        $faker = Faker::create('id_ID');

        echo $faker->numerify('19######') . "<br>";
        echo $faker->name() . "<br>";

        $tgl_lahir = $faker->dateTimeBetween('-4 years', );
        echo \Carbon\Carbon::parse($tgl_lahir)->isoFormat('dddd, D MMMM YYYY HH:mm') . "<br>";

        echo $faker->randomFloat(2, 1, 4);
    }

    public function fakerMahasiswaCreate()
    {
        $faker = Faker::create('id_ID');

        \App\Models\Mahasiswa::create([
            'nim' => $faker->numerify('19######'),
            'nama' => $faker->name(),
            'tanggal_lahir' => $faker->dateTimeBetween('-4 years'),
            'ipk' => $faker->randomFloat(2, 1, 4)
        ]);

        return "1 data berhasil di buat";
    }
    public function fakerMahasiswaCreateMany()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Mahasiswa::create([
                'nim' => $faker->numerify('19######'),
                'nama' => $faker->firstName() . " " . $faker->lastName(),
                'tanggal_lahir' => $faker->dateTimeBetween('-4 years'),
                'ipk' => $faker->randomFloat(2, 1, 4)
            ]);
        }
        // 'nim' => $faker->numberBetween(17, 19) . $faker->randomNumber(6), Angkanya kurang enak dilihat
        // 'nama' => $faker->name(), ada title yang nyeleneh

        return "10 data berhasil di buat";
    }
}