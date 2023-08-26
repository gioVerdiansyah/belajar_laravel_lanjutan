@extends('layouts.tamplate-table')
@section('title', 'Data Mahaiswa')


@section('data')
@isset ($mahasiswa)
<tr>
  <td>{{ $mahasiswa->id }}</td>
  <td>{{$mahasiswa->nim}}</td>
  <td>{{$mahasiswa->nama}}</td>
  <td>{{Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->isoFormat('DD-MM-Y')}}</td>
  <td>{{$mahasiswa->ipk}}</td>
  <td>{{Carbon\Carbon::parse($mahasiswa->created_at)->isoFormat('DD-MM-Y')}}</td>
  <td>{{Carbon\Carbon::parse($mahasiswa->updated_at)->isoFormat('DD-MM-Y')}}</td>
</tr>
@else
  <td colspan="6" class="text-center">Tidak ada data...</td>
@endisset
@endsection
