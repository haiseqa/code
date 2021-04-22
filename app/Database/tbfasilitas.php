<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbfasilitas extends Model
{
    protected $table ='tbfasilitas';
    public $incrementing = false;
    protected $primaryKey = 'id_fasilitas';
    protected $keyType = 'string';
    protected $fillable = [
        'id_fasilitas',
        'nama_fasilitas'
    ];
}
