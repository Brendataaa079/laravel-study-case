@php
    $portal = auth()->check()
        ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.index'))
        : route('login');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduSchool - Portal Informasi Sekolah</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>
<header class="lp-header">
    <div class="lp-left">
        <img src="{{ asset('img/logo.png') }}" alt="Logo sekolah" class="lp-logo" onerror="this.style.display='none'">
        <span class="lp-brand">EDUSCHOOL</span>
    </div>
    <nav class="lp-nav">
        <a href="#terbaru">Pengumuman</a>
    </nav>
    <a href="{{ $portal }}" class="lp-login">{{ auth()->check() ? 'Buka portal' : 'Masuk' }}</a>
</header>

<section class="lp-welcome">
    <h1>Selamat Datang di Eduschool</h1>
    <p>Temukan informasi terbaru tentang sekolah.</p>
</section>

<section class="lp-band">
    <h2>Informasi Penting Hari Ini</h2>
    <div class="lp-cards">
        @forelse ($terbaru->take(3) as $info)
            <div class="lp-card">
                <div class="lp-card-label">{{ $info->kategori }}</div>
                <div class="lp-card-body">{{ $info->judul }}</div>
                <small>{{ $info->tanggal_publikasi->format('d/m/Y') }}</small>
            </div>
        @empty
            <div class="lp-card"><div class="lp-card-body">Belum ada informasi.</div></div>
        @endforelse
    </div>
</section>

<section class="lp-bottom">
    <div>
        <h2>Akses Cepat</h2>
        <a href="{{ $portal }}" class="lp-quick">Lihat semua pengumuman</a>
        <a href="{{ $portal }}" class="lp-quick mint">Masuk ke portal</a>
        <a href="#kontak" class="lp-quick">Kontak admin</a>
    </div>
    <div id="terbaru">
        <h2>Informasi Terbaru</h2>
        <ul class="lp-list">
            @forelse ($terbaru as $info)
                <li>[{{ $info->tanggal_publikasi->format('d/m/Y') }}] {{ $info->judul }}</li>
            @empty
                <li>Belum ada informasi.</li>
            @endforelse
        </ul>
        @guest
            <p class="lp-note">Masuk untuk membaca isi pengumuman selengkapnya.</p>
        @endguest
    </div>
</section>

<footer class="lp-footer" id="kontak">
    <nav>
        <a href="#">FAQ</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#kontak">Kontak Admin</a>
    </nav>
    <div>&copy; 2026 EduSchool</div>
</footer>
</body>
</html>