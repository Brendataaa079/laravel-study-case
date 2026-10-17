<?php

namespace App\Http\Controllers;

use App\Models\Informasi;

class LandingController extends Controller
{
    public function index()
    {
        // 5 informasi aktif terbaru: 3 teratas jadi kartu, semuanya masuk daftar
        $terbaru = Informasi::aktif()
            ->orderByDesc('tanggal_publikasi')
            ->take(5)
            ->get();

        return view('landing', compact('terbaru'));
    }
}