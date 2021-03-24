<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbadmin extends Model
{
    protected $table = 'tbadmin';
    public $incrementing = fasle;
    protected $primaryKey = 'id_admin';
    protected $keyType = 'string';
    protected $fillable = [
        'id_admin',
        'id_user',
        'nama',
        'jenis_kelamin',
        'alamat',
        'nohp'
    ];
}
