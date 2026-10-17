<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan data untuk kartu statistik
        $totalInformasi = Informasi::count();
        $informasiAktif = Informasi::aktif()->count();
        $totalUsers     = User::count();

        // 5 informasi terbaru untuk tabel di dashboard
        $informasiTerbaru = Informasi::orderByDesc('tanggal_publikasi')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalInformasi',
            'informasiAktif',
            'totalUsers',
            'informasiTerbaru'
        ));
    }
}