<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    //public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password'
    ];
}
