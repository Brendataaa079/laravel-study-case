@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p class="sub">School information hub</p>

    <div class="stats">
        <div class="card stat">
            <div class="label">Total informasi</div>
            <div class="num">{{ $totalInformasi }}</div>
        </div>
        <div class="card stat">
            <div class="label">Total users</div>
            <div class="num">{{ $totalUsers }}</div>
        </div>
        <div class="card stat">
            <div class="label">Informasi aktif</div>
            <div class="num">{{ $informasiAktif }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <h3>Informasi terbaru</h3>
        </div>
        <table class="tbl">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul informasi</th>
                    <th>Kategori</th>
                    <th>Tanggal publikasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($informasiTerbaru as $i => $info)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $info->judul }}</td>
                        <td>{{ $info->kategori }}</td>
                        <td>{{ $info->tanggal_publikasi->format('Y-m-d') }}</td>
                        <td><span class="badge {{ $info->status }}">{{ ucfirst($info->status) }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Belum ada informasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection