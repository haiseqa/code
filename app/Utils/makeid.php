<?php
namespace App\Utils;

class makeid{
    public static function createId($length){
        $secret = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($secret), 0, $length);
    }
}
