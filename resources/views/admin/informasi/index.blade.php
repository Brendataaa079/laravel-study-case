@extends('layouts.admin')

@section('title', 'Kelola informasi')

@section('content')
    <h1>Kelola informasi sekolah</h1>
    <p class="sub">Buat, ubah, dan hapus informasi untuk user.</p>

    <div class="card">
        <form method="GET" class="toolbar">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul...">
            <select name="status">
                <option value="">Semua status</option>
                @foreach (\App\Models\Informasi::STATUS as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-sm ghost">Cari</button>
            <span class="spacer"></span>
            <a href="{{ route('admin.informasi.create') }}" class="btn">+ Tambah informasi baru</a>
        </form>

        <table class="tbl">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul informasi</th>
                    <th>Kategori</th>
                    <th>Tanggal publikasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($informasis as $info)
                    <tr>
                        <td>{{ $informasis->firstItem() + $loop->index }}</td>
                        <td>{{ $info->judul }}</td>
                        <td>{{ $info->kategori }}</td>
                        <td>{{ $info->tanggal_publikasi->format('Y-m-d') }}</td>
                        <td><span class="badge {{ $info->status }}">{{ ucfirst($info->status) }}</span></td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.informasi.show', $info) }}" class="btn-sm ghost">Lihat</a>
                                <a href="{{ route('admin.informasi.edit', $info) }}" class="btn-sm edit">Ubah</a>
                                <form method="POST" action="{{ route('admin.informasi.destroy', $info) }}"
                                      onsubmit="return confirm('Hapus informasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm del">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Belum ada informasi.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $informasis->links('pagination.simple') }}
    </div>
@endsection
