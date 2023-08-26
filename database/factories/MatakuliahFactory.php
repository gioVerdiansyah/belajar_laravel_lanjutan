<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_matakuliah' => fake()->unique()->bothify('??###'),
            'nama_matakuliah' => fake()->randomElement($this->daftar_matakuliah),
            'jumlah_sks' => fake()->numberBetween(1, 4),
            'nama_dosen' => fake('id_ID')->name()
        ];
    }
}