@extends('layouts.tamplate-table')
@section('title', 'Data Mahaiswa')


@section('data')
@forelse ($mahasiswa as $mhs)
<tr>
  <th>{{$mhs->id}}</th>
  <td>{{$mhs->nim}}</td>
  <td>{{$mhs->nama}}</td>
  <td>{{Carbon\Carbon::parse($mhs->tanggal_lahir)->isoFormat('DD-MM-Y')}}</td>
  <td>{{$mhs->ipk}}</td>
  <td>{{Carbon\Carbon::parse($mhs->created_at)->isoFormat('DD-MM-Y')}}</td>
  <td>{{Carbon\Carbon::parse($mhs->updated_at)->isoFormat('DD-MM-Y')}}</td>
</tr>
@empty
  <td colspan="7" class="text-center">Tidak ada data...</td>
@endforelse
@endsection

@section('pagination')
<div class="row mt-3">
    {{ $mahasiswa->links() }}
  </div>
@endsection
