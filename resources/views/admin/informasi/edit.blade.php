@extends('layouts.admin')

@section('title', 'Ubah informasi')

@section('content')
    <h1>Ubah informasi</h1>
    <p class="sub">Perbarui data informasi.</p>

    <div class="card" style="max-width: 640px">
        <form method="POST" action="{{ route('admin.informasi.update', $informasi) }}">
            @method('PUT')
            @include('admin.informasi._form')
        </form>
    </div>
@endsection