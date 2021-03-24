<?php

namespace App\Database;

use Illuminate\Database\Eloquent\Model;

class tbuser extends Model
{
    protected $table = 'tbuser';
    public $incrementing = false;
    protected $primaryKey = 'id_user';
    protected $keyType = 'string';
    protected $fillable = [
        'id_user',
        'username',
        'role',
        'password'
    ];
}
