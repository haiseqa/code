<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;


class pemilik_controller extends Controller
{
    function dashboard(){
        return view('Page.pemilik.dashboard');
    }

    function daftarvilla(){
        return view('Page.pemilik.daftarvilla');
    }

    function registrasi_villa(){
        return view('Page.pemilik.registrasi_villa');
    }
}
