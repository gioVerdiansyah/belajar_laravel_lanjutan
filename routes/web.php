<?php

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

// Alternative: Illuminate\Support\Carbon

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MahasiswaController as MHS;

Route::get('/generate', [MHS::class, 'generate']);
Route::get('/tampil/mahasiswa', [MHS::class, 'tampilMahasiswa']);
Route::get('/tambah/mahasiswa', [MHS::class, 'tambahMahasiswa']);
Route::get('/tambah/user', [MHS::class, 'tambahUser']);
Route::get('/tampil/user', [MHS::class, 'tampilUser']);


// ! Carbon
use App\Http\Controllers\CarbonController as CC;

// Carbon adalah nama library PHP untuk mengolah date and time (tanggal dan waktu).
Route::prefix('/carbon')->group(function () {
    Route::get('/1', [CC::class, 'one']);

    Route::get('/2', [CC::class, 'two']);

    // !Instansiasi Untuk Tanggal dan Waktu Tertentu
    Route::get('/3', [CC::class, 'three']);

    // ! Carbon Hari ini kemarin dan besok
    Route::get('/4', [CC::class, 'four']);


    // ! Selisih waktu
    Route::get('/5', [CC::class, 'five']);


    // ! GETTER
    Route::get('/getter-1', [CC::class, 'getter1']);
    Route::get('/getter-2', [CC::class, 'getter2']);
    Route::get('/getter-3', [CC::class, 'getter3']);
    Route::get('/getter-4', [CC::class, 'getter4']);

    // ! SETTER
    Route::get('/setter-1', [CC::class, 'setter1']);
    Route::get('/setter-2', [CC::class, 'setter2']);
    Route::get('/setter-3', [CC::class, 'setter3']);


    // ! Addition dan Subtraction
    Route::get('/add-sub', [CC::class, 'additionSubtraction']);


    // ! Comparison
    Route::get('/comparison-1', [CC::class, 'comparison']);
    Route::get('/comparison-2', [CC::class, 'comparisonBetween']);
    Route::get('/comparison-3', [CC::class, 'comparison3']);
    Route::get('/comparison-4', [CC::class, 'comparison4']);

    // ! Difference
    Route::get('/diff', [CC::class, 'difference']);
    Route::get('/diff-for-human', [CC::class, 'diffForHuman']);

    // ! Modifier
    Route::get('/modifier', [CC::class, 'modifier']);

    // ! Copying
    Route::get('/copy-1', [CC::class, 'copy1']);
    Route::get('/copy-2', [CC::class, 'copy2']);
    Route::get('/copy-3', [CC::class, 'copy3']);


    // ! Timezone
    Route::get('/timezone-1', [CC::class, 'timezone1']);
    Route::get('/timezone-2', [CC::class, 'timezone2']);


    // ! Localization
    Route::get('/local-1', [CC::class, 'local1']);
    Route::get('/local-2', [CC::class, 'local2']);
    Route::get('/local-3', [CC::class, 'local3']);
    Route::get('/local-4', [CC::class, 'local4']);


    // Menerapkan Carbon pada Eloquent
    Route::get('/tampil-mahasiswa', [CC::class, 'tampilMahasiswa']);
    Route::get('/cek-created-at', [CC::class, 'cekCreatedAt']);
    Route::get('/cek-tanggal-lahir', [CC::class, 'cekTanggalLahir']);
    Route::get('/cek-tanggal-lahir-carbon', [CC::class, 'cekTanggalLahirCarbon']);
});


// ! Scope

use App\Http\Controllers\ScopeController as SC;

Route::prefix('/scope')->group(function () {
    Route::get('/mahasiswa-ipk/{ipk?}', [SC::class, 'mahasiswaIpk']);
    Route::get('/mahasiswa-ipk-scope/{ipk?}', [SC::class, 'mahasiswaIpkScope']);
    Route::get('/mahasiswa-lahir/{tanggal_lahir?}', [SC::class, 'mahasiswaLahir']);
    Route::get('/mahasiswa-lahir-scope/{tanggal_lahir?}', [SC::class, 'mahasiswaLahirScope']);
    Route::get('/mahasiswa-scope-chaining/{tanggal_lahir?}/{ipk?}', [SC::class, 'mahasiswaScopeChaining']);
});


// ! Faker
use App\Http\Controllers\FakerController as FC;

Route::prefix('/faker')->group(function () {
    Route::get('/instance', [FC::class, 'instance']);
    Route::get('/method', [FC::class, 'fakerMethod']);

    Route::get('/loop/{index?}', [FC::class, 'fakerLoop'])
        ->where('index', '[1-9]|[1-4]|50'); //hanya samapai 50

    Route::get('/loop/lang/{lang?}', [FC::class, 'fakerLooplang'])
        ->where('lang', '[a-z]{2}_[A-Z]{2}');
    // berformat 2 huruf pertama kecil diikuti underscore lalu 2 huruf besar semua

    Route::get('/base', [FC::class, 'fakerBase']);
    Route::get('/number', [FC::class, 'fakerNumber']);
    Route::get('/address', [FC::class, 'fakerAddress']);
    Route::get('/phone', [FC::class, 'fakerPhone']);
    Route::get('/internet', [FC::class, 'fakerInternet']);
    Route::get('/date', [FC::class, 'fakerDate']);
    Route::get('/date-carbon', [FC::class, 'fakerDateCarbon']);
    Route::get('/date-interval', [FC::class, 'fakerDateInterval']);
    Route::get('/nik', [FC::class, 'fakerNIK']);
    Route::get('/seed', [FC::class, 'fakerSeed']);
    Route::get('/random-digit', [FC::class, 'fakerUniqueDigit']);
    Route::get('/random-element', [FC::class, 'fakerRandomElement']);
    Route::get('/optional', [FC::class, 'fakerOptional']);

    // Mahasiswa
    Route::get('/mahasiswa', [FC::class, 'fakerMahasiswa']);
    Route::get('/mahasiswa/create', [FC::class, 'fakerMahasiswaCreate']);
    Route::get('/mahasiswa/create-many', [FC::class, 'fakerMahasiswaCreateMany']);
});



// ! Factory
use App\Http\Controllers\FactoryController as FactoryC;

Route::prefix('/factory')->group(function () {
    Route::get('/', FactoryC::class); //untuk menjalankan factory
    Route::get('/mahasiswa', [FactoryC::class, 'mahasiswa']);
    Route::get('/mahasiswa-array', [FactoryC::class, 'mahasiswaArray']);
    Route::get('/mahasiswa-modif', [FactoryC::class, 'mahasiswaModif']);
    Route::get('/mahasiswa-modif', [FactoryC::class, 'mahasiswaCreate']);
    Route::get('/mahasiswa/create', [FactoryC::class, 'mahasiswaCreate']);
    Route::get('/mahasiswa/create/{jumlah}', [FactoryC::class, 'mahasiswaCreateMany'])
        ->where('jumlah', '[1-9]|[1-2]|30');

    // ! User
    Route::get('/user', [FactoryC::class, 'user']);
    Route::get('/user-state', [FactoryC::class, 'userState']);

    // ! Exercise
    Route::get('/mahasiswa/exercise', [FactoryC::class, 'mahasiswaExercise']);

    // generate 10 data Mahasiswa & Users
    Route::get('/mahasiswa-user/created', [FactoryC::class, 'mahasiswaUserCreated']);
});


// ! Case Generating Data
use App\Http\Controllers\MatakuliahController as Matkul;

Route::prefix('/matakuliah')->group(function () {
    Route::get('/test', [Matkul::class, 'test']);
    Route::get('/', [Matkul::class, 'index']);

    // Instance pagination methods
    Route::get('/pagination-methods', [Matkul::class, 'paginationMethods']);
});



// ! Eloquent Lanjutan
use App\Http\Controllers\DataMahasiswaController as DataMhs;

Route::prefix('/eloquent')->group(function () {
    Route::get('/add', [DataMhs::class, 'add']);
    Route::get('/show-data', [DataMhs::class, 'showData']);
    Route::get('/all', [DataMhs::class, 'all']);
    Route::get('/to-file-json', [DataMhs::class, 'toFileJson']);
    Route::get('/first', [DataMhs::class, 'first']);
    Route::get('/column', [DataMhs::class, 'column']);
    Route::get('/select', [DataMhs::class, 'select']);
    Route::get('/order-by/{by?}', [DataMhs::class, 'order']);
    Route::get('/in-random-order', [DataMhs::class, 'inRandomOrder']);
    Route::get('/where', fn() => redirect('/eloquent/where/ipk/>=/3'));
    Route::get('/where/{column?}/{kondisi?}/{value?}', [DataMhs::class, 'where']);
    Route::get('/and-where', [DataMhs::class, 'andWhere']);
    Route::get('/or-where', [DataMhs::class, 'orWhere']);
    Route::get('/or-where-closure', [DataMhs::class, 'orWhereClosure']);
    Route::get('/where-between', [DataMhs::class, 'whereBetween']);
    Route::get('/where-not-between', [DataMhs::class, 'whereNotBetween']);
    Route::get('/where-in', [DataMhs::class, 'whereIn']);
    Route::get('/where-not-in', [DataMhs::class, 'whereNotIn']);
    Route::get('/where-in-chaining1', [DataMhs::class, 'whereInChaining1']);
    Route::get('/where-in-chaining2', [DataMhs::class, 'whereInChaining2']);
    Route::get('/where-null', [DataMhs::class, 'whereNull']);
    Route::get('/where-not-null', [DataMhs::class, 'whereNotNull']);
    Route::get('/where-date', [DataMhs::class, 'whereDate']);
    Route::get('/where-month', [DataMhs::class, 'whereMonth']);
    Route::get('/where-day', [DataMhs::class, 'whereDay']);
    Route::get('/where-year', [DataMhs::class, 'whereYear']);
    Route::get('/where-time', [DataMhs::class, 'whereTime']);
    Route::get('/limit', [DataMhs::class, 'limit']);
    Route::get('/skip-and-take', [DataMhs::class, 'skipAndTake']);
    Route::get('/where-first', [DataMhs::class, 'whereFirst']);
    Route::get('/first-where', [DataMhs::class, 'firstWhere']);
    Route::get('/latest', [DataMhs::class, 'latest']);
    Route::get('/latest-first', [DataMhs::class, 'latestFirst']);
    Route::get('/find', [DataMhs::class, 'find']);
    Route::get('/finds', [DataMhs::class, 'finds']);
    Route::get('/find-or-fail', [DataMhs::class, 'findOrFail']);
    Route::get('/value1', [DataMhs::class, 'value1']);
    Route::get('/value2', [DataMhs::class, 'value2']);
    Route::get('/pluck', [DataMhs::class, 'pluck']);
    Route::get('/pluck-where', [DataMhs::class, 'pluckWhere']);
    Route::get('/exists-and-doesnt-exist', [DataMhs::class, 'existsAndDoesntExist']);
    Route::get('/aggregate', [DataMhs::class, 'aggregate']);
    Route::get('/first-or-create', [DataMhs::class, 'firstOrCreate']);
    Route::get('/first-or-new', [DataMhs::class, 'firstOrNew']);
    Route::get('/first-or', [DataMhs::class, 'firstOr']);
    Route::get('/update-or-create', [DataMhs::class, 'updateOrCreate']);
});