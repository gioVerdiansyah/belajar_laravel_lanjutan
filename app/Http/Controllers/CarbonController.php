<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa as Mhs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarbonController extends Controller
{
    public function one()
    {
        $carbon = new Carbon;

        dump($carbon);
        echo $carbon;
        // Seharusnya tidak bisa langsung di echo, namun karena di Carbon sudah menerapkan magic function __toString() maka bisa dan menghasilkan date dengan format YYYY-MM-DD HH:MM:SS
    }

    public function two()
    {
        echo new Carbon . "<hr>";
        echo new Carbon() . "<hr>";
        echo Carbon::now() . "<hr>";
        echo Carbon::parse() . "<hr>";
        echo Carbon::create('now') . "<hr>";

        // Intinya semua cara di atas adalah sama, sama-sama menampilkan waktu sekarang
    }

    public function three()
    {
        echo new Carbon('1 December 2022') . "<hr>"; // 2022-12-01 00:00:00
        echo new Carbon('12:20:34') . "<hr>"; // 2023-07-12 12:20:34
        echo new Carbon('30-12-2022 23:59:59') . "<hr>"; // 2022-12-30 23:59:59

        echo Carbon::parse('24 June 20236:30:1') . "<hr>"; //2023-06-24 06:30:01
        echo Carbon::create('24 June 2022') . "<hr>"; // 2022-06-24 00:00:00
        echo Carbon::create('1 August 2022 14:15:5') . "<hr>"; // 2022-08-01 14:15:05

        echo Carbon::createFromDate(2023, 2, 5) . "<hr>";
        echo Carbon::createFromTime(12, 5, 32) . "<hr>";
        echo Carbon::createFromTimestamp(1669504215) . "<hr>"; // bisa didapat misal dari Carbon::now()->timestamp

        echo Carbon::create(2007, 6, 24, 5, 30, 27) . "<hr>";
        echo Carbon::create(2022, 12);
    }

    public function four()
    {
        echo Carbon::now() . "<hr>";
        echo Carbon::today() . "<hr>";
        echo Carbon::yesterday() . "<hr>";
        echo Carbon::tomorrow() . "<hr>";

        echo Carbon::create('now') . "<hr>";
        echo Carbon::create('today') . "<hr>";
        echo Carbon::create('yesterday') . "<hr>";
        echo Carbon::create('tomorrow') . "<hr>";
    }

    public function five()
    {
        echo Carbon::now() . "<hr>";
        echo Carbon::create("+1 hour") . "<hr>";
        echo Carbon::create("+5 day") . "<hr>";
        echo Carbon::create("-10 day") . "<hr>";
        echo Carbon::create("+1 month +5 hour") . "<hr>";
        echo Carbon::create("+5 hour +2 week +1 year") . "<hr>";
    }


    // ! GETTER
    public function getter1()
    {
        $getter = Carbon::create(2023, 3, 22, 6, 5);

        echo $getter . "<hr>";
        echo $getter->toTimeString() . "<hr>";
        echo $getter->toDateString() . "<hr>";
        echo $getter->format('d M Y') . "<hr>";
    }

    public function getter2()
    {
        $carbon = Carbon::now();

        echo $carbon . "<hr>";
        echo $carbon->isoFormat('D/M/YY HH:mm') . "<hr>";
        echo $carbon->isoFormat('dddd, D MMM YYYY HH:mm') . "<hr>";
        echo $carbon->isoFormat('LLLL') . "<hr>";

        // Kesimpulan, jika huruf format lebih banyak maka akan lebih detail
    }
    public function getter3()
    {
        $carbon = Carbon::now();

        echo $carbon . "<hr>";
        echo $carbon->second . "<hr>";
        echo $carbon->minute . "<hr>";
        echo $carbon->hour . "<hr>";
        echo $carbon->day . "<hr>";
        echo $carbon->month . "<hr>";
        echo $carbon->year . "<hr>";

        echo "<br>";

        echo $carbon->quarter . "<hr>";
        echo $carbon->dayName . "<hr>";
        echo $carbon->monthName . "<hr>";

        echo "<br>";

        // misal umur saya
        $myAge = Carbon::create(2007, 6, 24);
        echo $myAge->age . "<hr>";
        echo $myAge->timespan() . "<hr>";
    }
    public function getter4()
    {
        echo Carbon::create('-1 hour')->diffForHumans() . "<hr>";
        echo Carbon::create('+1 hour')->diffForHumans() . "<hr>";
        echo Carbon::create('+3 month')->diffForHumans() . "<hr>";
        echo Carbon::create(2022, 12, 30, 19, 30, 21)->diffForHumans() . "<hr>";
        echo Carbon::create(1999, 6, 24)->diffForHumans() . "<hr>";
        echo Carbon::createFromTimestamp(1669504215)->diffForHumans() . "<hr>";

        // Method diffForHumans() menampilkan perbedaan waktu dengan kata-kata yang sering digunakan oleh manusia
    }


    // ! SETTER
    public function setter1()
    {
        $carbon = Carbon::now();

        echo $carbon . "<hr>";

        $carbon->second = 30;
        $carbon->minute = 12;
        $carbon->hour = 20;
        $carbon->day = 05;
        $carbon->month = 01;
        $carbon->year = 2023;

        // Jadi kita sekarang me set ulang nilai yang sudah ada

        echo $carbon;
    }

    public function setter2()
    {
        $carbon = Carbon::now();

        echo $carbon . "<hr>";

        $carbon->setDay(10);
        $carbon->setMonth(06);
        $carbon->setYear(2020);
        echo $carbon . "<hr>";

        $carbon->set('day', 19);
        $carbon->set('month', 05);
        $carbon->set('year', 2021);
        echo $carbon . "<hr>";

        $carbon->setTime(10, 19, 23);
        $carbon->setDate(2010, 8, 24);
        echo $carbon . "<hr>";

        $carbon->setDateTime(2012, 9, 25, 7, 19, 24);
        echo $carbon . "<hr>";
    }

    public function setter3()
    {
        $carbon = Carbon::now();
        echo $carbon . "<hr>";

        $carbon->year(2020)->month(4)->day(24)->hour(21)->minute(19)->second(22);
        echo $carbon;
    }


    // ! Addition dan Subtraction
    // adalah kumpulan method untuk menambah serta mengurangi nilai tanggal dan waktu yang sudah tersimpan dalam Carbon object

    public function additionSubtraction()
    {
        $carbon = Carbon::create(2023, 1, 1, 12, 30, 15);
        echo $carbon . "<hr>";

        $carbon->addDay();
        echo $carbon . "<hr>";

        $carbon->addDays(5);
        echo $carbon . "<hr>";

        $carbon->addWeek();
        echo $carbon . "<hr>";

        $carbon->addMonths(7);
        echo $carbon . "<hr>";

        $carbon->subMonths(4);
        echo $carbon . "<hr>";

        $carbon->addYears(2);
        echo $carbon . "<hr>";

        $carbon->subYears(3);
        echo $carbon . "<hr>";


        $carbon = Carbon::create(2023, 1, 1, 12, 30, 15);
        echo $carbon . "<hr>";

        $carbon->addWeekdays(3); //menambah tanggal sebanyak jumlah hari
        echo $carbon . "<hr>";

        $carbon->addHours(5)->addMinutes(10)->addSeconds(15);
        echo $carbon . "<hr>";
    }


    // ! Comparison
    // Operasi lain yang sering dilakukan untuk data tanggal adalah membandingkan apakah tanggal yang satu didahului oleh tanggal yang lain
    public function comparison()
    {
        $carbon1 = Carbon::create(2023, 1, 1);
        $carbon2 = Carbon::create(2022, 1, 1);

        dump($carbon1 == $carbon2); //false
        dump($carbon1 != $carbon2); //true
        dump($carbon1 > $carbon2); //true
        dump($carbon1 < $carbon2); //false
        dump($carbon1 >= $carbon2); //true
        dump($carbon1 <= $carbon2); //false


        dump($carbon1->greaterThan($carbon2)); //true
        dump($carbon1->gt($carbon2)); //true

        dump($carbon1->lessThan($carbon2)); //false
        dump($carbon1->lt($carbon2)); //false
    }


    // ! Between
    // memeriksa apakah sebuah tanggal berada di antara 2 tanggal lain.
    public function comparisonBetween()
    {
        $carbon1 = Carbon::create(2023, 1, 1);
        $carbon2 = Carbon::create(2022, 1, 1);
        $carbon3 = Carbon::create(2021, 1, 1);


        dump($carbon1->between($carbon2, $carbon3)); //false
        dump($carbon2->between($carbon1, $carbon3)); //true karena carbon2 di tengah-tengah

        // Secara default, method between() akan menghasilkan nilai true meskipun tanggal yang dibandingkan sama. Ini dibuktikan dari perintah di baris 263, yang meskipun Carbon::create(2023, 1, 1) sama dengan isi tanggal di $carbon1, hasilnya adalah true

        dump(Carbon::create(2023, 1, 1)->between($carbon1, $carbon2)); //true
        dump(Carbon::create(2024, 1, 1)->between($carbon1, $carbon2, false)); //false
        // Jika kita ingin membatasi agar tanggal yang diperiksa harus lebih besar, maka bisa tambah nilai false sebagai argument ketiga pada saat menulis method between(). Dengan tambahan ini, maka jika tanggal yang dibandingkan sama, hasilnya akan false dan baru true jika tanggal tersebut lebih besar.
    }

    public function comparison3()
    {
        $carbon = Carbon::create(2023, 1, 1);

        dump($carbon->isWeekday()); //false
        dump($carbon->isWeekend()); //true
        dump($carbon->isMonday()); //false
        dump($carbon->isTuesday()); //false
        dump($carbon->isWednesday()); //false
        dump($carbon->isThursday()); //false
        dump($carbon->isFriday()); //false
        dump($carbon->isSaturday()); //false
        dump($carbon->isSunday()); //true
    }

    public function comparison4()
    {
        $carbon = Carbon::create('+1 day');

        echo explode(' ', $carbon)[0];
        dump($carbon->isToday()); //false
        dump($carbon->isTomorrow()); //true
        dump($carbon->isNextDay()); //true
        dump($carbon->isPast()); //false
        dump($carbon->isFuture()); //true
        dump($carbon->isLeapYear()); //false (tahun kabisat)
        dump($carbon->isNextYear()); //false
    }

    // ! Difference
    // method difference kita bisa mencari berapa banyak perbedaan antara tanggal yang satu dengan tanggal yang lain.
    public function difference()
    {
        $carbon1 = Carbon::create(2023, 1, 1, );
        $carbon2 = Carbon::create(1945, 8, 17, );

        dump($carbon1->diffInYears($carbon2));
        dump($carbon1->diffInMonths($carbon2));
        dump($carbon1->diffInDays($carbon2));
    }

    // Difference for Human
    // jika jarak antara tanggal tidak terlalu jauh, akan ditampilkan seperti 1 second before atau 1 week before, namun jika perbedaan tanggal cukup jauh, akan ditampilkan dalam satuan bulan atau tahun

    public function diffForHuman()
    {
        $carbon1 = Carbon::create(2023, 1, 1, 10, 21, 1);

        dump($carbon1->diffForHumans($carbon1));
        dump($carbon1->diffForHumans(Carbon::create(2022)));
        dump($carbon1->diffForHumans(Carbon::create(2023, 6, 10)));
        dump($carbon1->diffForHumans(Carbon::today()));
    }


    // ! Modifier
    // Modifier adalah method yang dipakai untuk memodifikasi tanggal yang sudah tersimpan di Carbon object. Sekilas ini mirip seperti Setter, tapi modifier memodifikasi tanggal sekaligus, bukan per komponen seperti setter.
    public function modifier()
    {
        $carbon = Carbon::create(2023, 1, 1, 10, 20, 30);
        echo $carbon . "<hr>"; //2023-01-01 10:20:30
        echo $carbon->endOfDay() . "<hr>"; //2023-01-01 23:59:59

        // echo $carbon->startOfDay(); //maka akan menimpa

        echo Carbon::create(2023, 1, 1)->startOfDay() . "<hr>"; //2023-01-01 00:00:00
        echo Carbon::create(2023, 1, 1)->startOfWeek() . "<hr>"; //2022-12-26 00:00:00
        echo Carbon::create(2023, 1, 1)->endOfWeek() . "<hr>"; //2023-01-01 23:59:59
        echo Carbon::create(2023, 1, 1)->nextWeekday() . "<hr>"; //2023-01-02 00:00:00
        echo Carbon::create(2023, 1, 1)->endOfMonth() . "<hr>"; //2023-01-31 23:59:59
        echo Carbon::create(2023, 1, 1)->endOfYear() . "<hr>"; //2023-12-31 23:59:59
        echo Carbon::create(2023, 1, 1)->endOfDecade() . "<hr>"; //2029-12-31 23:59:59
        echo Carbon::create(2023, 1, 1)->endOfMillennium() . "<hr>"; //3000-12-31 23:59:59
    }

    // Copying
    public function copy1()
    {
        $carbon1 = Carbon::create(2023, 1, 1, 21, 30, 1);
        $carbon2 = $carbon1->endOfWeek();
        echo $carbon1 . "<hr>"; //2023-01-01 23:59:59
        echo $carbon2 . "<hr>"; //2023-01-01 23:59:59

        // karena di variabel carbon2 saya memanggil object endOfWeek maka property yang sudah tersimpan saat create menjadi ikut berubah
    }

    public function copy2()
    {
        // Agar menghindari kesalahan di atas maka kita memerlukan method 1 lagi sebelum di copy
        $carbon1 = Carbon::create(2023, 1, 1, 21, 30, 1);
        $carbon2 = $carbon1->copy()->endOfWeek();
        echo $carbon1 . "<hr>"; //2023-01-01 21:30:01
        echo $carbon2 . "<hr>"; //2023-01-01 23:59:59
    }

    public function copy3()
    {
        // cara kedua kita bisa menggunakan class
        $carbon1 = \Carbon\CarbonImmutable::create(2023, 1, 1, 21, 30, 1);
        $carbon2 = $carbon1->endOfWeek();
        echo $carbon1 . "<hr>"; //2023-01-01 21:30:01
        echo $carbon2 . "<hr>"; //2023-01-01 23:59:59
    }


    // ! TImezone
    // Sejak tadi kita menggunakan Timezone GMT atau UTC, untuk Indonesia sendiri adalah UTC+7
    // ? Daftar lengkap timezone: https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
    public function timezone1()
    {
        // GMT
        echo Carbon::now() . "<hr>"; //2023-07-19 14:40:02
        echo Carbon::create('now', 'UTC') . "<hr>"; //2023-07-19 14:40:02

        // Eropa
        echo Carbon::create('now', 'Europe/London') . "<hr>"; //2023-07-19 15:40:02

        // Indonesia
        echo Carbon::create('now', 'Asia/Jakarta') . "<hr>"; //2023-07-19 21:40:02
        echo Carbon::create('now', 'Asia/Makassar') . "<hr>"; //2023-07-19 21:40:02
        echo Carbon::create('now', 'Asia/Jayapura') . "<hr>"; //2023-07-19 21:40:02
    }

    public function timezone2()
    {
        echo Carbon::now('Asia/Jakarta') . "<hr>";
        echo Carbon::yesterday('Asia/Jakarta') . "<hr>";
        echo Carbon::tomorrow('Asia/Jakarta') . "<hr>";
        echo Carbon::createFromDate(2023, 1, 1, 'Asia/Jakarta') . "<hr>";
    }


    // ! Localization
    // Mengubah nama-nama hari dan bulan kesuatu bahasa tertentu
    // format local lengkap: https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
    public function local1()
    {
        Carbon::setlocale('id');
        $carbon = Carbon::create(2023, 1, 1, 22, 15, 10);

        echo $carbon . "<hr>";
        echo $carbon->isoFormat('D/M/YY HH:mm:ss') . "<hr>";
        echo $carbon->isoFormat('dddd') . "<hr>";
        echo $carbon->isoFormat('dddd, D MMMM YYYY HH:mm') . "<hr>";
        echo $carbon->isoFormat('LLLL') . "<hr>";
    }

    public function local2()
    {
        // Agar mengubah timezonenya sekaligus
        $carbon1 = Carbon::now();
        echo $carbon1 . "<hr>";

        $carbon2 = Carbon::now('Asia/Jakarta');
        echo $carbon2 . "<hr>";
    }

    public function local3()
    {
        // local saat pembuatan carbon
        $carbon1 = Carbon::create(2023, 1, 1, 30, 20, 10)->locale('id');
        echo $carbon1 . "<hr>";
        echo $carbon1->diffForHumans() . "<hr>";
        echo $carbon1->tzName . "<hr>"; //UTC
        echo $carbon1->dayName . "<hr>"; //Senin
        echo $carbon1->monthName . "<hr>"; //Januari
        echo $carbon1->minDayName . "<hr>"; //Sn

        $carbon2 = Carbon::tomorrow('Asia/Jakarta')->locale('id');
        echo $carbon2 . "<hr>";
        echo $carbon2->diffForHumans() . "<hr>";
        echo $carbon2->format('l, d F Y') . "<hr>"; //Monday, 02 January 2023
        // hasil dari method format() langsung diambil dari DateTime object bawaan PHP, sehingga tidak otomatis di translate
    }

    // sudah saya atur config untuk timezone dan locale menjadi indonesia
    public function local4()
    {
        $carbon1 = Carbon::now();
        echo $carbon1->isoFormat('dddd, D MMMM YYYY HH:mm');

        echo "<br>";

        $carbon2 = Carbon::create(2024, 1, 1);
        echo $carbon2->diffForHumans();
    }

    public function tampilMahasiswa()
    {
        $mahasiswas = Mhs::all();

        foreach ($mahasiswas as $mhs) {
            echo "{$mhs->nim} | {$mhs->nama} | {$mhs->tanggal_lahir} | {$mhs->ipk} | {$mhs->created_at} | {$mhs->updated_at}<hr>";
        }
    }

    public function cekCreatedAt()
    {
        $mahasiswa = Mhs::find(5)->created_at;

        dump($mahasiswa);
        echo Carbon::create($mahasiswa)->isoFormat('dddd, D MMMM YYYY HH:mm');
    }

    public function cekTanggalLahir()
    {
        $mhs = Mhs::find(5)->tanggal_lahir;

        dump($mhs);
        dump(Carbon::create($mhs));
        dump(Carbon::create($mhs)->age);
    }


    public function cekTanggalLahirCarbon()
    {
        $mhs = Mhs::find(5);

        dump($mhs->tanggal_lahir);
        echo "Umur {$mhs->nama} sekarang berumur {$mhs->tanggal_lahir->age} tahun";
    }
}