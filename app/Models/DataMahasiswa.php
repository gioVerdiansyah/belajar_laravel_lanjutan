<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;
    protected $table = "data_mahasiswa", $guarded = [];

    // menonaktifkan timestamps
    // public $timestamps = false;

    // nilai default
    protected $attributes = [
        'nama' => 'user',
        'ipk' => 1.00
    ],
    $cast = [
        'tanggal_lahir' => 'datetime'
    ];
}