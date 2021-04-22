<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Database\tbfasilitas;
use App\Utils\makeid;

use function GuzzleHttp\Promise\all;

class fasilitas_controller extends Controller
{
    function fasilitas(Request $req){
        $fasilitas = tbfasilitas::get();

        return view('Page.admin.fasilitas', [
            'fasilitas'     => $fasilitas
        ]);
    }

    function tambah_fasilitas(Request $req){
        // dd($req->all());
        $tambah_fasilitas = tbfasilitas::create([
            'id_fasilitas'      => makeid::createId(10),
            'nama_fasilitas'    => $req-> input('nama')
        ]);
        if($tambah_fasilitas){
            return redirect()->route('admin.fasilitas')->with('message','data berhasil ditambah');
        }

        return redirect()->route('admin.fasilitas')->with('message', 'data gagal ditambah');
    }

    function edit_fasilitas(Request $req, $idfasilitas){

        $fasilitas = tbfasilitas::find($idfasilitas);
        return view('Page.admin.edit_fasilitas', [
            'fasilitas'     => $fasilitas
        ]);
    }

    function postedit_fasilitas(Request $req, $idfasilitas){
        // dd($req->all());
        $fasilitas = tbfasilitas::find($idfasilitas)->update([
            'nama_fasilitas'  => $req->input('nama')
        ]);

        if($fasilitas){
            return redirect()->route('admin.fasilitas')->with('message','data berhasil diedit');
        }

        return back()->with('Profile Gagal Diedit');
    }
}
