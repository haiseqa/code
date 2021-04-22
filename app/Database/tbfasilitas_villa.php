<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbfasilitas_villa extends Model
{
    protected $table = 'tbfasilitas_villa';
    public $incrementing = false;
    protected $primaryKey = 'string';
    protected $keyType = 'string';
    protected $fillable = [
        'id_fasilitas_villa',
        'id_fasilitas',
        'id_villa'
    ];
}
