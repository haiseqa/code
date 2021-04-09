<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbvilla extends Model
{
    protected $table = 'tbvilla';
    public $incrementing = false;
    protected $primaryKey = 'id_villa';
    protected $keyType = 'string';
    protected $fillable = [
        'id_villa',
        'id_pemilik',
        'nama_villa',
        'alamat_villa',
        'harga_villa',
        'deskripsi',
        'longitude',
        'latitude',
        'status',
        'status_villa'
    ];
}
