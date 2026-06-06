<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'nim';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'nim',
        'username',
        'prodi',
        'password'
    ];

    public function histories()
    {
        return $this->hasMany(History::class, 'nim_mahasiswa', 'nim');
    }
}
