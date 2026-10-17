<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // READ: daftar + pencarian + filter status
    public function index(Request $request)
    {
        $informasis = Informasi::query()
            ->when($request->q, fn ($query, $kw) => $query->where('judul', 'like', "%{$kw}%"))
            ->when($request->status, fn ($query, $st) => $query->where('status', $st))
            ->orderByDesc('tanggal_publikasi')
            ->paginate(10)
            ->withQueryString();

        return view('admin.informasi.index', compact('informasis'));
    }

    // CREATE: form
    public function create()
    {
        $informasi = new Informasi(['status' => 'draft', 'tanggal_publikasi' => now()]);

        return view('admin.informasi.create', compact('informasi'));
    }

    // CREATE: simpan
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;

        Informasi::create($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    // READ: detail
    public function show(Informasi $informasi)
    {
        return view('admin.informasi.show', compact('informasi'));
    }

    // UPDATE: form
    public function edit(Informasi $informasi)
    {
        return view('admin.informasi.edit', compact('informasi'));
    }

    // UPDATE: simpan
    public function update(Request $request, Informasi $informasi)
    {
        $informasi->update($this->validated($request));

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

    // Aturan validasi dipakai bersama oleh store dan update
    private function validated(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'in:' . implode(',', Informasi::KATEGORI)],
            'isi' => ['required', 'string'],
            'tanggal_publikasi' => ['required', 'date'],
            'status' => ['required', 'in:' . implode(',', Informasi::STATUS)],
        ], [
            'judul.required' => 'Judul wajib diisi.',
            'judul.max' => 'Judul maksimal 150 karakter.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'isi.required' => 'Isi informasi wajib diisi.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib diisi.',
            'tanggal_publikasi.date' => 'Format tanggal tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);
    }
}