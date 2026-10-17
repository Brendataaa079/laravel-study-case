<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun pengujian (forceCreate supaya kolom 'role' pasti tersimpan)
        $admin = User::forceCreate([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.test',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::forceCreate([
            'name' => 'Budi Santoso',
            'email' => 'user@sekolah.test',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // Data awal informasi
        $data = [
            ['Jadwal Ujian Tengah Semester', 'Akademik', '2026-10-15', 'aktif'],
            ['Libur Nasional', 'Umum', '2026-10-05', 'arsip'],
            ['Pendaftaran Ekstrakurikuler', 'Kegiatan', '2026-09-30', 'draft'],
            ['Rapat Orang Tua Kelas XI', 'Umum', '2026-10-25', 'aktif'],
            ['Perubahan Jadwal Praktik Bengkel', 'Akademik', '2026-10-24', 'aktif'],
        ];

        foreach ($data as [$judul, $kategori, $tanggal, $status]) {
            Informasi::create([
                'user_id' => $admin->id,
                'judul' => $judul,
                'kategori' => $kategori,
                'isi' => 'Isi lengkap informasi: ' . $judul . '.',
                'tanggal_publikasi' => $tanggal,
                'status' => $status,
            ]);
        }
    }
}