@extends('layouts.admin')

@section('title', 'Detail informasi')

@section('content')
    <h1>{{ $informasi->judul }}</h1>
    <p class="sub">Detail informasi sekolah</p>

    <div class="card" style="max-width: 640px">
        <dl class="detail" style="margin-top:0">
            <dt>Kategori</dt><dd>{{ $informasi->kategori }}</dd>
            <dt>Tanggal publikasi</dt><dd>{{ $informasi->tanggal_publikasi->format('d-m-Y') }}</dd>
            <dt>Status</dt><dd><span class="badge {{ $informasi->status }}">{{ ucfirst($informasi->status) }}</span></dd>
            <dt>Dibuat oleh</dt><dd>{{ $informasi->user->name }}</dd>
            <dt>Isi</dt><dd>{{ $informasi->isi }}</dd>
        </dl>
        <div class="form-actions">
            <a href="{{ route('admin.informasi.edit', $informasi) }}" class="btn">Ubah</a>
            <a href="{{ route('admin.informasi.index') }}" class="btn ghost">Kembali</a>
        </div>
    </div>
@endsection