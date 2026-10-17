@extends('layouts.user')

@section('title', 'Detail pengumuman')

@section('content')
    <div class="u-wrap">
        <div class="u-card" style="cursor:default">
            <div class="u-card-top">
                <span class="u-tag">{{ $informasi->kategori }}</span>
                <span>{{ $informasi->tanggal_publikasi->format('d-m-Y') }}</span>
            </div>
            <h1 style="margin:0 0 12px">{{ $informasi->judul }}</h1>
            <p style="white-space:pre-line">{{ $informasi->isi }}</p>
            <div class="u-by" style="margin-bottom:16px">Diterbitkan oleh {{ $informasi->user->name }}</div>
            <a href="{{ route('user.index') }}" class="btn-blue">Kembali</a>
        </div>
    </div>
@endsection