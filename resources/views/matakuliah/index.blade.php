@extends('layouts.template1')
@section('cdn', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css')
@section('title', 'Data Matakuliah')

@section('content')
<div class="container mt-3">
    <div class="row">
      <div class="col-12">

      <div class="py-4">
        <h2>Tabel Matakuliah</h2>
      </div>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Kode Matakuliah</th>
            <th>Nama Matakuliah</th>
            <th>Jumlah SKS</th>
            <th>Nama Dosen</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($matakuliahs as $matakuliah)
          <tr>
            <th>{{$matakuliah->id}}</th>
            <td>{{$matakuliah->kode_matakuliah}}</td>
            <td>{{$matakuliah->nama_matakuliah}}</td>
            <td style="text-align: center">{{$matakuliah->jumlah_sks}}</td>
            <td>{{$matakuliah->nama_dosen}}</td>
          </tr>
          @empty
            <td colspan="6" class="text-center">Tidak ada data...</td>
          @endforelse
        </tbody>
      </table>
      <div class="row mt-3">
        {{-- {{ $matakuliahs->links() }} --}}
        {{-- {{ $matakuliahs->appends(['sort' => 'nama_dosen'])->links() }} --}}
        {{--
             Query string biasa dipakai untuk membuat semacam fitur filter ke dalam pagination. Berikut contoh penerapan query string di halaman pagination Tokopedia:
             https://tokopedia.com/search?st=product&q=laptop&page=3

             st untuk bagian kategori dan q adalah keyword dari pencarian
        --}}

        {{-- {{ $matakuliahs->fragment('content')->links() }} --}}
        {{-- Hash fragment #content --}}

        {{-- {{ $matakuliahs->onEachSide(1)->links() }} --}}
        {{--
            Each on side
            < 1| 2| ... 9| 10| 11 ... | 19| 20 >
        --}}
        {{-- ! Generate Tamplate Link pagination --}}
        {{-- php artisan vendor:publish --tag=laravel-pagination --}}

        {{-- menngunakan dari vendor.pagination --}}
        {{-- {{ $matakuliahs->links('vendor.pagination.semantic-ui') }} --}}

        {{-- Menggunakan pagination saya sendiri --}}
        {{ $matakuliahs->links('vendor.pagination.my-pagenation') }}
        </div>
      </div>
    </div>
  </div>
@endsection
