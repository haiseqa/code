<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbpemilik extends Model
{
    protected $table = 'tbpemilik';
    public $incremeting = false;
    protected $primaryKey = 'id_pemilik';
    protected $keyType = 'string';
    protected $fillable = [
        'id_pemilik',
        'id_user',
        'nama',
        'jenis_kelamin',
        'alamat',
        'nohp',
        'email',
        'foto_profile'
    ];
}
