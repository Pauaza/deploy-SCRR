<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkripsiAlumni extends Model
{
    protected $table = 'skripsi_alumni';

    public $timestamps = false;

    protected $fillable = [
        'judul_skripsi',
        'id_pembimbing_1',
        'id_pembimbing_2'
    ];

    //  Relasi pembimbing 1
    public function pembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_1');
    }

    //  Relasi pembimbing 2
    public function pembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'id_pembimbing_2');
    }
}
