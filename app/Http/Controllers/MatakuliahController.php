<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatakuliahController extends Controller
{
    protected $daftar_matakuliah = [
        "Matematika",
        "Fisika Dasar",
        "Kimia Dasar",
        "Pengantar Rekayasa & Desain",
        "Pengenalan Teknologi Informasi",
        "Bahasa Inggris",
        "Olah Raga",
        "Pengantar Rekayasa & Desain",
        "Tata Tulis Karya Ilmiah",
        "Pengantar Analisis Rangkaian",
        "Algoritma & Struktur Data",
        "Matematika Diskrit",
        "Logika Informatika",
        "Probabilitas & Statistika",
        "Aljabar Geometri",
        "Organisasi & Arsitektur Komputer",
        "Pemrograman Berorientasi Objek",
        "Strategi Algoritma",
        "Teori Bahasa Formal dan Otomata",
        "Sistem Operasi",
        "Basis Data",
        "Dasar Rekayasa Perangkat Lunak",
        "Pengembangan Aplikasi Berbasis Web",
        "Pengembangan Aplikasi pada Platform Khusus",
        "Jaringan Komputer",
        "Manajemen Proyek Perangkat Lunak",
        "Manajemen Basis Data",
        "Interaksi Manusia & Komputer",
        "Inteligensi Buatan",
        "Agama dan Etika",
        "Sistem Paralel dan Terdistribusi",
        "Sistem Informasi",
        "Riset Operasi",
        "Grafika Komputer",
        "Socio-Informatika dan Profesionalisme",
        "Wawasan Teknologi & Komunikasi Ilmiah",
        "Algoritma & Struktur Data",
        "Bahasa Inggris",
        "Pengantar Sistem Operasi",
        "Arsitektur SI/TI Perusahaan",
        "Kepemimpinan & Ketrampilan Interpersonal",
        "Statistika",
        "Desain & Manajemen Proses Bisnis",
        "Desain & Manajemen Jaringan Komputer",
        "Dasar-Dasar Pengembangan Perangkat Lunak",
        "Pengantar Basis Data",
        "Pemrograman Berorientasi Objek",
        "Analisis & Desain Perangkat Lunak",
        "Interaksi Manusia & Komputer",
        "Keamanan Aset Informasi",
        "Desain Basis Data",
        "Pemrograman Berbasis Web",
        "Sistem Cerdas",
        "Konstruksi & Pengujian Perangkat Lunak",
        "Tata Tulis Ilmiah",
        "Manajemen Proyek TI",
        "Simulasi Sistem",
        "Tata Kelola TI",
        "Perencanaan Sumber Daya Perusahaan",
        "Manajemen Layanan TI",
        "Dasar Pemrograman",
        "Proyek Perangkat Lunak",
        "Manajemen Resiko TI"
    ];
    public function test()
    {
        echo "Kode Matakuliah: " . fake()->unique()->bothify('??###') . "<br>";
        // 2 huruf acak lalu disambung 3 huruf
        echo "Nama Matakuliah: " . fake()->randomElement($this->daftar_matakuliah) . "<br>";
        echo "Jumlah SKS: " . fake()->numberBetween(1, 4) . "<br>";
        echo "Nama Dosen: " . fake('id_ID')->name();

        // DIsarankan selalu membuat priview dulu disini sebelum di pindahkan ke Factory
    }

    public function index()
    {
        $matakuliahs = Matakuliah::paginate(5); //simplePaginate()
        return view('/matakuliah/index', ['matakuliahs' => $matakuliahs]);
    }

    public function paginationMethods(): View
    {
        return view('matakuliah.pagination-methods', ['matkul' => Matakuliah::paginate(5)]);
    }
}