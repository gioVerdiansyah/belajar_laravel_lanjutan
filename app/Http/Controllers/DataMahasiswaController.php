<?php

namespace App\Http\Controllers;

use App\Models\DataMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DataMahasiswaController extends Controller
{
    public function add()
    {
        DataMahasiswa::create([
            'nim' => fake()->unique()->numerify('19######'),
            'nama' => fake('id_ID')->firstName() . ' ' . fake('id_ID')->lastName(),
            'tanggal_lahir' => fake()->dateTimeBetween('-4 years'),
            'ipk' => fake()->randomFloat(2, 2, 4)
        ]);

        return "1 Data berhasil ditambahkan";
    }

    public function showData(): View
    {
        return view('data-mahasiswa.data-mahasiswas-p', ['mahasiswa' => DataMahasiswa::paginate(10)]);
    }

    public function all()
    {
        $mahasiswa = DataMahasiswa::paginate(10);
        // dump($mahasiswa);
        // dump($mahasiswa->toArray());

        return view('data-mahasiswa.data-mahasiswas-p', compact('mahasiswa'));
    }

    public function toFileJson()
    {
        // ini hanya uji coba saya saja
        $folder = 'data_json';
        $filename = 'mahasiswa.json';
        Storage::put($folder . '/' . $filename, DataMahasiswa::all()->toJson());

        // Dump the file path for verification
        dump(storage_path('app/' . $folder . '/' . $filename));
    }

    // ! Method all() dan get()
    public function column()
    {
        echo "get : ";
        dump(DataMahasiswa::get(['nama', 'ipk'])->toArray());

        echo "all : ";
        dump(DataMahasiswa::all(['nama', 'ipk'])->toArray());
    }

    // ! Method select()
    public function select()
    {
        $result = DataMahasiswa::select('nim', 'nama', 'ipk')->get();
        dump($result->toArray());
    }

    // ! Method orderBy(), orderByDesc(), dan inRandomOrder()
    //  mengurutkan baris tabel berdasarkan kolom tertentu.
    public function order($by = 'desc')
    {
        $mahasiswa = DataMahasiswa::orderBy('ipk', $by)->paginate(10);
        return view('data-mahasiswa.data-mahasiswas-p', compact('mahasiswa'));
    }
    // paginate sama saja seperti get namun di batasi

    public function inRandomOrder()
    {
        $mahasiswa = DataMahasiswa::inRandomOrder()->paginate(5);
        // Akan terus berganti saat refresh
        return view('data-mahasiswa.data-mahasiswas-p', compact('mahasiswa'));
    }

    // ! Method where()
    // Fungsinya untuk membatasi tampilan data tabel berdasarkan kondisi tertentu.
    public function where(string $column = 'ipk', string $kondisi = '>=', $value = 3.00)
    {
        $mahasiswa = DataMahasiswa::where($column, $kondisi, $value)->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    public function andWhere()
    {
        $mahasiswa = DataMahasiswa::where([
            ['tanggal_lahir', 'LIKE', '2000%'],
            ['ipk', '>=', 3]
        ])->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! Method orWhere()
    //
    public function orWhere()
    {
        $mahasiswa = DataMahasiswa::where('nama', 'LIKE', '%i')
            ->orWhere('ipk', '>=', 2.5)
            ->Where('ipk', '<=', 3)
            ->get();
        // SELECT * FROM data_mahasiswa WHERE nama LIKE '%i' OR ipk > 2.7 AND ipk < 3.0;
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function orWhereClosure()
    {
        $mahasiswa = DataMahasiswa::where('nama', 'LIKE', '%i')
            ->orWhere(function ($query) {
                $query->where('ipk', '>=', 2.5)->where('ipk', '<=', 3);
            })->get();
        // SELECT * FROM data_mahasiswa WHERE nama LIKE '%i' OR (ipk > 2.7 AND ipk < 3.0);
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! Method whereBetween() dan whereNotBetween()
    // Keduanya dipakai untuk membatasi tampilan data berdasarkan range atau jangkauan tertentu.
    public function whereBetween()
    { //Antara
        $mahasiswa = DataMahasiswa::whereBetween('ipk', [2.5, 3.0])->get();
        // SELECT * FROM data_mahasiswa WHERE ipk BETWEEN 2.7 AND 3.0;
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereNotBetween()
    { //Selain di antara
        $mahasiswa = DataMahasiswa::whereNotBetween('ipk', [2.5, 3.0])->get();
        // SELECT * FROM data_mahasiswa WHERE ipk NOT BETWEEN 2.7 AND 3.0;
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! Method whereIn() dan whereNotIn()
    //  dipakai untuk mencari data berdasarkan beberapa nilai tertentu yang persis sama.
    public function whereIn()
    { //sama persis
        $mahasiswa = DataMahasiswa::whereIn('ipk', [2.30, 3.20])->get();
        // SELECT * FROM data_mahasiswa WHERE ipk IN (2.7,3.0);
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereNotIn()
    { //sama persis
        $mahasiswa = DataMahasiswa::whereNotIn('id', [1, 2, 3])->get();
        // SELECT * FROM data_mahasiswa WHERE id NOT IN (2.7,3.0);
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    public function whereInChaining1()
    {
        $mahasiswa = DataMahasiswa::whereIn('ipk', [2.30, 3.20])
            ->whereNotIn('id', [1, 2, 3, 4])
            ->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereInChaining2()
    {
        $mahasiswa = DataMahasiswa::whereIn('ipk', [2.30, 3.20])
            ->orWhereNotIn('id', [1, 2, 3, 4])
            ->get();
        // SELECT * FROM data_mahasiswa WHERE ipk IN (2.30,3.20) OR id NOT IN (1,2,3,4);
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! Method whereNull() dan whereNotNull()
    // untuk menampilkan data berdasarkan apakah terdapat kolom yang bernilai NULL atau tidak
    public function whereNull()
    {
        $mahasiswa = DataMahasiswa::whereNull('tanggal_lahir')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
        // SELECT * FROM data_mahasiswa WHERE tanggal_lahir IS NULL;
        // Hasilnya tidak muncul data karena cell tanggal_lahir tidak ada yang NULL
    }
    public function whereNotNull()
    {
        $mahasiswa = DataMahasiswa::whereNotNull('tanggal_lahir')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
        // SELECT * FROM data_mahasiswa WHERE tanggal_lahir IS NOT NULL;
    }

    // ! Method whereDate(), whereMonth(), whereDay(), whereYear() dan whereTime()
    // dipakai untuk proses seleksi kolom bertipe tanggal dan waktu (DATE, TIME atau DATETIME).
    public function whereDate()
    {
        $mahasiswa = DataMahasiswa::whereDate('tanggal_lahir', '2002-08-31')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereMonth()
    {
        $mahasiswa = DataMahasiswa::whereMonth('tanggal_lahir', '10')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereDay()
    {
        $mahasiswa = DataMahasiswa::whereDay('tanggal_lahir', '>=', '10')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereYear()
    {
        $mahasiswa = DataMahasiswa::whereYear('tanggal_lahir', '2000')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function whereTime()
    {
        $mahasiswa = DataMahasiswa::whereTIme('created_at', '>', '10:00:00')->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    // Semuanya bisa dikasih kondisi
    // SELECT * FROM data_mahasiswa WHERE tanggal_lahir = '2002-08-31';
    // SELECT * FROM data_mahasiswa WHERE MONTH(tanggal_lahir) = '10';
    // SELECT * FROM data_mahasiswa WHERE DAY(tanggal_lahir) >= '10';
    // SELECT * FROM data_mahasiswa WHERE YEAR(tanggal_lahir) = '2000';
    // SELECT * FROM data_mahasiswa WHERE TIME(created_at) > '10:00:00';

    // ! Method limit()
    // dipakai untuk membatasi data yang tampil berdasarkan urutan baris.
    public function limit()
    {
        $mahasiswa = DataMahasiswa::orderBy('id', 'desc')->limit(5)->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! Method skip() dan take()
    // untuk mengambil sebagian data berdasarkan urutan baris. Method skip() dipakai untuk melompati baris, sedangkan take() untuk mengambil baris.
    public function skipAndTake()
    {
        $mahasiswa = DataMahasiswa::orderBy('id', 'asc')->skip(3)->take(5)->get();
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }

    // ! first() dan firstWhere()
    public function first()
    {
        $mahasiswa = DataMahasiswa::first();
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }
    public function whereFirst()
    {
        $mahasiswa = DataMahasiswa::where('ipk', '<', 3.00)->first();
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }
    public function firstWhere()
    {
        $mahasiswa = DataMahasiswa::firstWhere('ipk', '<', 3.00);
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // ! Method latest()
    // Mengurutkan data berdasarkan data terbaru ke data terlama
    public function latest()
    {
        $mahasiswa = DataMahasiswa::latest()->paginate(10);
        return view('data-mahasiswa.data-mahasiswas-p', compact('mahasiswa'));
    }
    public function latestFIrst()
    {
        $mahasiswa = DataMahasiswa::latest()->first();
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // ! Method find() dan findOrFail()
    public function find()
    {
        $mahasiswa = DataMahasiswa::find(10);
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }
    public function finds()
    {
        $mahasiswa = DataMahasiswa::find([1, 2, 3, 4, 5]);
        return view('data-mahasiswa.data-mahasiswas', compact('mahasiswa'));
    }
    public function findOrFail()
    { // Jadi akan Not Found bukan terjadi error
        $mahasiswa = DataMahasiswa::findOrFail(100);
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // ! Method value()
    // untuk mengambil satu nilai kolom dari suatu baris data. Nama kolom tersebut diinput sebagai argument ke dalam method value()
    public function value1()
    {
        $mahasiswa = DataMahasiswa::value('nama');
        echo $mahasiswa;
    }
    public function value2()
    {
        $mahasiswa = DataMahasiswa::where('nama', 'Vera Kuswandari')->value('ipk');
        echo $mahasiswa;
    }

    // ! Method pluck()
    // untuk mengambil semua nilai data untuk satu kolom. Kolom yang ingin diambil diinput sebagai argument
    public function pluck()
    {
        $mahasiswa = DataMahasiswa::pluck('nama');
        dump($mahasiswa);
    }
    public function pluckWhere()
    {
        $mahasiswa = DataMahasiswa::where('nama', 'LIKE', '%i')->pluck('ipk');
        dump($mahasiswa);
    }

    // ! Method exists() dan doesntExist()
    // Kedua method mengembalikan nilai boolean true atau false tergantung apakah data di temukan atau tidak
    public function existsAndDoesntExist()
    {
        $exists = DataMahasiswa::where('ipk', '>=', 4)->exists();
        dump($exists); //false

        $exists = DataMahasiswa::where('nama', 'LIKE', '%a')->exists();
        dump($exists); //true

        $doesntExists = DataMahasiswa::where('ipk', '>=', 4)->doesntExist();
        dump($doesntExists); //true

        $doesntExists = DataMahasiswa::where('nama', 'LIKE', '%a')->doesntExist();
        dump($doesntExists); //false
    }

    // ! Method count(), max(), min() dan avg()
    public function aggregate()
    {
        $count = DataMahasiswa::where('nama', 'LIKE', '%e%')->count();
        dump($count); //6

        $max = DataMahasiswa::all()->max('ipk');
        dump($max); //3.95

        $max = DataMahasiswa::all()->max('tanggal_lahir'); //paling muda
        dump($max); //2002-09-01

        $min = DataMahasiswa::all()->min('ipk');
        dump($min); //2.19

        $min = DataMahasiswa::all()->min('tanggal_lahir'); //paling tua
        dump($min); //1991-04-07

        $avg = DataMahasiswa::all()->avg('ipk');
        dump($avg); //3.0135
    }

    // ! Method firstOrCreate()
    // merupakan gabungan dari method first() dan create(). Jika data  yang dicari ada di dalam tabel, method ini mengembalikan satu eloquent model, atau sama seperti hasil method first(). Namun jika tidak ditemukan, data baru akan dibuat, sama seperti fungsi method create().
    public function firstOrCreate()
    {
        // Jika ditemukan
        // $mahasiswa = DataMahasiswa::firstOrCreate(['nama' => 'Shania Pradipta']);

        // Jika tidak ditemukan
        // Jika hanya menambah nama maka akan error kerena di dalam struktur tabel ada beberapa cell yang memerlukan data untuk di isi, maka solusinya:
        $mahasiswa = DataMahasiswa::firstOrCreate(
            ['nama' => 'Sofyan Gio Verdiansyah'],
            [
                'nim' => fake()->unique()->numerify('19######'),
                'tanggal_lahir' => fake()->dateTimeBetween('1990-01-01', '2004-01-01')
            ]
        );
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // ! Method firstOrNew()
    // Method firstOrNew() sebenarnya mirip seperti firstOrCreate(). Bedanya, jika data yang dicari tidak ditemukan, method ini tidak langsung menginput data baru ke dalam database, tapi hanya mengembalikan model object.
    public function firstOrNew()
    {
        $mahasiswa = DataMahasiswa::firstOrNew(
            ['nama' => 'Adi Kurniawan'],
            [
                'nim' => fake()->unique()->numerify('19######'),
                'tanggal_lahir' => fake()->dateTimeBetween('1990-01-01', '2004-01-01')
            ]
        );

        // Jika ingin menyimpannya kedalam DataBase
        // $mahasiswa->save();
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // ! Method firstOr()
    // Method firstOr() merupakan versi generik atau versi umum dari gabungan method first() dan "sesuatu". Maksud "sesuatu" di sini adalah suatu function yang bisa kita input sebagai argument ke dalam method firstOr().
    public function firstOr()
    {
        // $mahasiswa = DataMahasiswa::where('nama', 'Sandi Pradana')
        //     ->firstOr(fn() => DataMahasiswa::find(21));
        $mahasiswa = DataMahasiswa::where('nama', 'Sandi Pradana')
            ->firstOr(function () {
                return \App\Models\Mahasiswa::factory()->make();
                //Bisa juga memanggil factory dari sini
            });
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }

    // Method updateOrCreate()
    // Jika data yang dicari sudah ada di dalam tabel, maka lakukan proses update(). Namun jika data tersebut tidak ditemukan, lakukan proses create().
    public function updateOrCreate()
    {
        $mahasiswa = DataMahasiswa::updateOrCreate(
            ['nama' => 'Sofyan Gio Verdiansyah'],
            [
                'nim' => fake()->unique()->numerify('19######'),
                'tanggal_lahir' => fake()->dateTimeBetween('1990-01-01', '2007-01-01')
            ]
        );
        return view('data-mahasiswa.data-mahasiswa', compact('mahasiswa'));
    }
}