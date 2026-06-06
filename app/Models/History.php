<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model 
{
    protected $table = 'history'; // Sesuaikan dengan nama di migration

    protected $fillable = [
        'nim_mahasiswa',
        'topik',
        'deskripsi_ide',
        // 'metode_pilihan',
        'hasil_rekomendasi'
    ];

    // Memberitahu Laravel agar memformat data ini sebagai JSON/Array
    protected $casts = [
        'hasil_rekomendasi' => 'array', 
    ];

    // Relasi balik ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa', 'nim');
    }
}