@extends('layouts.template1')
@section('title', 'Tes Pagination Method')

@section('content')
    {{ $matkul->links('vendor.pagination.pagination-methods') }}
@endsection
