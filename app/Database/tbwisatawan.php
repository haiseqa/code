<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbwisatawan extends Model
{
    protected $table = 'tbwisatawan';
    public $incrementing = false;
    protected $primaryKey = 'id_wisatawan';
    protected $keyType = 'string';
    protected $fillable = [
        'id_wisatawan',
        'nama',
        'jenis_kelamin',
        'alamat',
        'nohp',
        'email'
    ];
}
