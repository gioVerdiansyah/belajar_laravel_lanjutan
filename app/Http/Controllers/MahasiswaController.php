<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function generate()
    {
        Mahasiswa::create(
            [
                'nim' => '19003036',
                'nama' => 'Sari Citra Lestari',
                'tanggal_lahir' => '2001-12-31',
                'ipk' => 3.62,
            ]
        );
        Mahasiswa::create(
            [
                'nim' => '19021044',
                'nama' => 'Rudi Permana',
                'tanggal_lahir' => '2000-08-22',
                'ipk' => 2.99,
            ],
        );
        Mahasiswa::create(
            [
                'nim' => '19002033',
                'nama' => 'Rina Kumala Sari',
                'tanggal_lahir' => '2000-06-28',
                'ipk' => 3.82,
            ],
        );
        Mahasiswa::create(
            [
                'nim' => '18012012',
                'nama' => 'James Situmorang',
                'tanggal_lahir' => '1999-04-02',
                'ipk' => 2.74,
            ]
        );

        User::create(
            [
                'name' => 'Adi',
                'email' => 'adi@gmail.com',
                'password' => Hash::make('adi kurniawan'),
            ]
        );

        return "Penambahan data tabel berhasil";
    }

    public function tampilMahasiswa()
    {
        foreach (Mahasiswa::all() as $mhs) {
            echo "<ul>
            <li>NIM: {$mhs->nim}</li>" .
                // <li>Nama: " . strtolower($mhs->nama) . "</li>
                "<li>Nama: {$mhs->nama}</li>"
                . "
            <li>Tanggal Lahir: {$mhs->tanggal_lahir}</li>
            <li>IPK: {$mhs->ipk}</li>
            " .
                // Dari costum Accessor
                "<li>{$mhs->namaBesar}</li>" . "
        </ul>";

            // ! Accessor
            // Bayangkan jika kita memiliki banyak controller dan di setiap controller menggunakan data dari DB lalu misal ada aturan baru nama harus besar semua atau kecil semua pasti ini akan merepotkan, inilah fungsi Accessor
        }
    }

    public function tambahMahasiswa()
    {
        Mahasiswa::create([
            'nim' => '19002793',
            'nama' => 'Riana Putria',
            'tanggal_lahir' => '2000-07-12',
            'ipk' => 3.78,
        ]);
        return "Penambahan data tabel berhasil";
    }

    public function tambahUser()
    {
        User::create([
            'name' => "Beta",
            'email' => 'betadwi@gmail.com',
            'password' => 'kepoo yaa'
        ]);
        // password akan di hash oleh mutator
        return "Penambahan data tabel berhasil";
    }

    public function tampilUser()
    {
        foreach (User::all() as $user) {
            echo "Name: {$user->name} | Email: {$user->email} | Password: {$user->password} <hr>";
        }
    }
}