<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Configuration\Builder;


// !Scope
// Scope adalah suatu method di dalam Model yang bisa dipakai menyimpan query, terutama query WHERE. Pada dasarnya, scope berfungsi untuk mempersingkat penulisan query yang sering digunakan. Mari kita lihat contoh kasusnya.

class ScopeController extends Controller
{

    // Method untuk foreach
    protected function pecah(Mahasiswa|Collection $mahasiswa)
    {
        if ($mahasiswa instanceof Mahasiswa || $mahasiswa instanceof Collection) {
            foreach ($mahasiswa as $mhs) {
                echo $mhs->nama . "<br>";
            }
        } else {
            return "Harus instance of Mahasiswa atau Collection mas brooow";
        }
    }
    public function mahasiswaIpk(float $ipk = 2)
    {
        $mahasiswas = Mahasiswa::where('ipk', '>=', $ipk)->orderBy('nama', 'desc')->get();

        $this->pecah($mahasiswas);
    }

    // Menggunakan scope
    public function mahasiswaIpkScope(float $ipk = 2)
    {
        $mahasiswas = Mahasiswa::cumlaude($ipk)->get();

        $this->pecah($mahasiswas);
    }

    public function mahasiswaLahir(string $tanggal_lahir = '2000')
    {
        $mahasiswas = Mahasiswa::whereYear('tanggal_lahir', '=', $tanggal_lahir)->get();

        $this->pecah($mahasiswas);
    }
    public function mahasiswaLahirScope(string $tanggal_lahir = '2000')
    {
        $mahasiswas = Mahasiswa::lahir($tanggal_lahir)->get();

        $this->pecah($mahasiswas);
    }
    // Scope Chaining
    public function mahasiswaScopeChaining(string $tanggal_lahir = '2000', float $ipk = 2)
    {
        $mahasiswas = Mahasiswa::lahir($tanggal_lahir)->cumlaude($ipk)->get();

        $this->pecah($mahasiswas);
    }
}
