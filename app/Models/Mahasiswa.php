<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Accessor dipakai untuk memproses data sebelum ditampilkan dari database,sedangkan
// mutator dipakai untuk memproses data sebelum di input ke database

// For Accessor
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];


    // Penulisan Accessor
    // return Attribute::make(
    //  get: fn ($value) => //... perintah untuk accessor di sini
    //  jika kode accesssor terlalu panjang bisa ditulis seperti function pada biasanya
    // );

    //! Membuat Accessor
    // public function nama(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn(string $value) => strtoupper("# " . $value), //arrow notation
    //         // ! Membuat Mutator
    //         // Sama dengan Accessor namun sekarang menggunakan set
    //         set: fn(string $value) => strtolower($value)
    //     );
    // }

    // public function tanggalLahir(): Attribute
    // {
    //     return Attribute::make(
    //         get: function (string $value) {
    //             $nama_bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    //             $tanggal = date('j', strtotime($value));
    //             $bulan = date('n', strtotime($value)) - 1; //karena index array
    //             $tahun = date('Y', strtotime($value));

    //             return "$tanggal $nama_bulan[$bulan] $tahun";
    //         }
    //     );
    // }

    public function namaBesar(): Attribute
    {
        return Attribute::make(
            get: fn() => strtoupper($this->attributes['nama'])
        );
    }

    // ! Mengakses Data Kolom di Accessor
    // 1. $this->attributes['nama_kolom']
    // 2. Argument pertama dari anonymous function.
    // (hanya bisa dilakukan dengan nama function yang sama dan di dalam kolom DB)
    // 3. $this->nama_kolom
    // 4. Argument kedua dari anonymous function. Contoh:
    // get: fn ($value, array $attributes) => strtoupper($attributes['nama'])


    // ! Attribute Casting
    // Attribute casting adalah fitur untuk mengubah (casting) tipe data dari suatu kolom sebelum ditampilkan oleh eloquent

    protected $casts = [
        // 'ipk' => 'integer',
        //yang tadinya tipe decimal saat di tampilkan maka akan berubah menjadi integer
        'ipk' => 'decimal:1',
        // panjang decimal hanya 1 digit saja

        // ! untuk Carbon
        'tanggal_lahir' => 'datetime'
    ];


    // ! Scope
    // ? Penulisan Scope
    // public function scope<NamaScope>(Builder $query): void
    // {
    // $query->...;
    // }
    public function scopeCumlaude(Builder $query, float $ipk): void
    {
        $query->where('ipk', '>=', $ipk);
    }

    public function scopeLahir(Builder $query, $tanggal_lahir)
    {
        $query->whereYear('tanggal_lahir', '=', $tanggal_lahir);
    }
}