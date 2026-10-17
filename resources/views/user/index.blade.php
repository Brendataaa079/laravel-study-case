@extends('layouts.user')

@section('title', 'Pengumuman sekolah')

@section('content')
    <div class="u-hero">
        <h1>Pengumuman Sekolah</h1>
        <p>Tetap terhubung dengan informasi akademik dan kegiatan terbaru sekolah.</p>
    </div>

    <div class="u-wrap">
        <div class="u-bar">
            <span class="u-count">{{ $informasis->total() }} pengumuman</span>
            <form method="GET" class="u-search">
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pengumuman...">
                <button type="submit" class="btn-blue">Cari</button>
            </form>
        </div>

        <div class="u-chips">
            <a href="{{ route('user.index', ['q' => request('q')]) }}"
               class="chip {{ request('kategori') ? '' : 'active' }}">Semua</a>
            @foreach (\App\Models\Informasi::KATEGORI as $k)
                <a href="{{ route('user.index', ['kategori' => $k, 'q' => request('q')]) }}"
                   class="chip {{ request('kategori') === $k ? 'active' : '' }}">{{ $k }}</a>
            @endforeach
        </div>

        @forelse ($informasis as $info)
            @php
                $featured = $loop->first
                    && $informasis->currentPage() === 1
                    && !request()->hasAny(['q', 'kategori']);
            @endphp
            <a href="{{ route('user.show', $info->id) }}" class="u-card {{ $featured ? 'featured' : '' }}">
                <div class="u-card-top">
                    <span class="u-tag">{{ $featured ? 'Terbaru · ' : '' }}{{ $info->kategori }}</span>
                    <span>{{ $info->tanggal_publikasi->format('d-m-Y') }}</span>
                </div>
                <h3>{{ $info->judul }}</h3>
                <p>{{ \Illuminate\Support\Str::limit($info->isi, 160) }}</p>
                <div class="u-by">Diterbitkan oleh {{ $info->user->name }}</div>
            </a>
        @empty
            <div class="u-card">Belum ada pengumuman.</div>
        @endforelse

        {{ $informasis->links('pagination.simple') }}

        @if ($informasis->count() > 0 && !$informasis->hasMorePages())
            <div class="u-end">Semua pengumuman telah ditampilkan.</div>
        @endif
    </div>
@endsection