<?php
namespace App\Utils;

use Session;
use Hash;
use App\Utils\makeid;
use App\Database\tbadmin;
use App\Database\tbpemilik;
use App\Database\tbwisatawan;

class authUser{
    public static function islogin(){
        if(Session::has('login')){
            if(Session::get('login') === "TRUE"){
                return true;
            }
        return false;
        };
    }

    public static function isadmin(){
        if(Session::has('role')){
            if(Session::get('role') === "admin"){
                return true;
        }
        return false;
    }
    }

    public static function ispemilik(){
        if(Session::has('role')){
            if(Session::get('role') === "pemilik"){
                return true;
            }
        return false;
        }
    }

    public static function iswisatawan(){
        if(Session::has('role')){
            if(Session::get('role') === "wisatawan"){
                return true;
            }
            return false;
        }
    }
}
