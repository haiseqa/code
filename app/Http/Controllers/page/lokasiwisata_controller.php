<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tblokasi_wisata;
use App\Utils\makeid;

class lokasiwisata_controller extends Controller
{
    function lokasi_wisata(Request $req){
        $lokasiwisata = tblokasi_wisata::get();

        return view('Page.admin.lokasi_wisata',[
            'lokasiwisata' => $lokasiwisata
        ]);
    }

    function tambah_lokasi_wisata(Request $req){
        // dd($req->all());
        $tambah_lokasi_wisata = tblokasi_wisata::create([
            'id_lokasi_wisata'      => makeid::createId(10),
            'nama_wisata'    => $req-> input('nama_wisata'),
            'latitude'       => $req-> input('latitude'),
            'longitude'      => $req-> input('longitude')
        ]);
        if($tambah_lokasi_wisata){
            return redirect()->route('admin.lokasi_wisata')->with('message','data berhasil ditambah');
        }

        return redirect()->route('admin.lokasi_wisata')->with('message', 'data gagal ditambah');
    }

    function edit_lokasi_wisata(Request $req, $idlokasi_wisata){

        $lokasiwisata = tblokasi_wisata::find($idlokasi_wisata);
        return view('Page.admin.edit_lokasi_wisata', [
            'lokasiwisata'     => $lokasiwisata
        ]);
    }

    function editpost_lokasi_wisata(Request $req, $idlokasi_wisata){
        // dd($req->all());
        $lokasiwisata = tblokasi_wisata::find($idlokasi_wisata)->update([
            'nama_wisata'  => $req->input('nama_wisata'),
            'latitude'     => $req->input('latitude'),
            'longitude'    => $req->input('longitude')
        ]);

        if($lokasiwisata){
            return redirect()->route('admin.lokasi_wisata')->with('message','Data berhasil disimpan');
        }

        return back()->with('message', 'Data gagal disimpan');
    }

    function delete_lokasi_wisata($idlokasi_wisata,Request $req){
        $delete = tblokasi_wisata::find($idlokasi_wisata)->delete();
        if($delete){
            return back()->with('message','Data Telah dihapus');
        }
        return back()->with('message','Data gagal dihapus');
    }




}
