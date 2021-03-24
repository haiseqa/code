<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbfoto_villa extends Model
{
    protected $table = 'tbfoto_villa';
    public $incrementing = false;
    protected $primaryKey = 'id_foto_villa';
    protected $keyType = 'string';
    protected $fillable = [
        'id_foto_villa',
        'id_villa',
        'path'
    ];
}
