<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabDosen extends Model
{
    protected $table = 'lab_dosen';
    protected $primaryKey = 'id_lab';

    public $timestamps = false;

    protected $fillable = [
        'nama_lab'
    ];

    //  Relasi ke dosen
    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'id_lab');
    }
}
