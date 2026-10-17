@extends('layouts.admin')

@section('title', 'Tambah informasi')

@section('content')
    <h1>Tambah informasi baru</h1>
    <p class="sub">Isi data informasi yang akan ditampilkan ke user.</p>

    <div class="card" style="max-width: 640px">
        <form method="POST" action="{{ route('admin.informasi.store') }}">
            @include('admin.informasi._form')
        </form>
    </div>
@endsection