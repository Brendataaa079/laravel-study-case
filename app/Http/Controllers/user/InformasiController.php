<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // Daftar pengumuman: hanya yang berstatus aktif
    public function index(Request $request)
    {
        $informasis = Informasi::aktif()
            ->with('user')
            ->when($request->q, fn ($query, $kw) => $query->where('judul', 'like', "%{$kw}%"))
            ->when($request->kategori, fn ($query, $k) => $query->where('kategori', $k))
            ->orderByDesc('tanggal_publikasi')
            ->paginate(8)
            ->withQueryString();

        return view('user.index', compact('informasis'));
    }

    // Detail: informasi draft/arsip tidak bisa dibuka user (404)
    public function show($id)
    {
        $informasi = Informasi::aktif()->with('user')->findOrFail($id);

        return view('user.show', compact('informasi'));
    }
}