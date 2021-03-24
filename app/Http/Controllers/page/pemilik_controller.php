<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbvilla;
use App\Utils\makeid;

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

    function tambah_vila(Request $req){
        return view('Page.pemilik.tambah_villa');
    }

    function tambah_vila_post(Request $req){
        $data = $req->all();
        // dd($data);
        $pemilik = tbpemilik::where([
            'id_user'   => $req->session()->get('iduser')
        ])->first();

        if(empty($pemilik)){
            return back()->with('message', 'data pemilik tidak sesuai');
        }

        $villa = tbvilla::create([
            'id_villa'      => makeid::createId(10),
            'id_pemilik'    => $pemilik->id_pemilik,
            'nama_villa'    => $data['nama'],
            'alamat_villa'  => $data['alamat'],
            'harga_villa'   => $data['harga'],
            'deskripsi'     => $data['deskripsi'],
            'longitude'     => $data['longitude'],
            'latitude'      => $data['latitude'],
        ]);

        if($villa){
            return back()->with('message', 'data villa berhasil ditambahkan');
        }
        return back()->with('message', 'data villa gagal ditambahkan');
    }
}
