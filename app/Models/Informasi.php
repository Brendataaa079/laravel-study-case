<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasis';

    public const KATEGORI = ['Akademik', 'Umum', 'Kegiatan'];
    public const STATUS = ['aktif', 'draft', 'arsip'];

    protected $fillable = ['user_id', 'judul', 'kategori', 'isi', 'tanggal_publikasi', 'status'];

    protected $casts = ['tanggal_publikasi' => 'date'];

    // Relasi: satu informasi dibuat oleh satu user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hanya informasi aktif yang tampil ke user
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}