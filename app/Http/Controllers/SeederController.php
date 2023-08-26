<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// ! Seeder
// Seeder (Database: Seeding), adalah file khusus yang berguna untuk proses pengisian data awal ke tabel database. Jika migration dipakai untuk proses generate struktur tabel, maka seeder merupakan tempat men-generate data tabel tersebut
class SeederController extends Controller
{
    // Proses generate data atau seeder bisa di tulis di 2 tempat:
    // 1. File 'master seeder' di database\seeders\DatabaseSeeder.php.
    // 2. File seeder terpisah. php artisan make:seeder <namaFileSeeder>

    // ! Seeder dari File CSV
    // Dimana kita me import data dari spredsheet
    // Proses import data ke MySQL akan lebih mudah jika data asal sudah dalam format .csv. Format CSV (singkatan dari Comma Separated Values)

    // ! Menggunakan CSV
    // Kita memerlukan library tambahan: composer require flynsarmy/csv-seeder:2.*
}