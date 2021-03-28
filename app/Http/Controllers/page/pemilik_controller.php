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

    function daftarvilla(Request $req){
        $villa = tbvilla::join('tbpemilik as pemilik', 'pemilik.id_pemilik', '=', 'tbvilla.id_villa')
        ->select('tbvilla.*')
        ->where([
            'pemilik.id_user'   => $req->session()->get('iduser')
        ])->get();
        return view('Page.pemilik.daftarvilla',[
            'villa'     =>$villa
        ]);
    }

    function registrasi_villa(){
        return view('Page.pemilik.registrasi_villa');
    }

    function tambah_vila(Request $req){
        $villa = tbvilla::join('tbpemilik as pemilik', 'pemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->where([
            'pemilik.id_user' => $req->session()->get('iduser')
        ])->get()->toJson();
        // dd($villa);
        return view('Page.pemilik.tambah_villa',[
            'data_villa' => $villa
        ]);
    }

    function edit_villa_post(Request $req){
        $villa = tbvilla::find($req->input('id_villa_modal'))->update($req->all());
        if($villa){
            return redirect()->route('pemilik.vila.tambah')->with('message', 'berhasil');
        }
        return redirect()->route('pemilik.vila.tambah')->with('message', 'gagal');
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
            'status'        => $data['status']
        ]);

        if($villa){
            tbuser::find($req->session()->get('iduser'))->update([
                'status'    => 'enable'
            ]);
            $req->session()->put([
                'status'    => 'enable'
            ]);
            return redirect()->route('pemilik.registrasi_villa')->with('message', 'data villa berhasil ditambahkan');
        }
        return back()->with('message', 'data villa gagal ditambahkan');
    }
}
