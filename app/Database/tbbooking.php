<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbbooking extends Model
{
    protected $table = 'tbbooking';
    public $incrementing = false;
    protected $primaryKey = 'string';
    protected $keyType = 'string';
    protected $fillable = [
        'id_booking',
        'nama_booking',
        'Alamat',
        'email',
        'nohp',
        'id_villa',
        'waktu_booking',
        'status_booking'
    ];
}
