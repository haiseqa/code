<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tblokasi_wisata extends Model
{
    protected $table = 'tblokasi_wisata';
    public $incrementing = false;
    protected $primaryKey = 'id_lokasi_wisata';
    protected $keyType = 'string';
    protected $fillable = [
        'id_lokasi_wisata',
        'longitude',
        'latitude',
        'nama_wisata'
    ];
}
