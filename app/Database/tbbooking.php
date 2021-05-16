<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbbooking extends Model
{
    protected $table = 'tbbooking';
    public $incrementing = false;
    protected $primaryKey = 'id_booking';
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
