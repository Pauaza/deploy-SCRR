<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenelitianDosen extends Model
{
    protected $table = 'penelitian_dosen';

    public $timestamps = false;

    protected $fillable = [
        'id_dosen',
        'judul_penelitian',
        'abstrak_penelitian',
        'tahun_publikasi'
    ];

    //  Relasi ke dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
