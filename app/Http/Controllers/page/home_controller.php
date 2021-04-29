<?php

namespace App\Http\Controllers\page;

use App\Database\tbfasilitas_villa;
use App\Database\tbfoto_villa;
use App\Database\tblokasi_wisata;
use App\Database\tbvilla;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class home_controller extends Controller
{
    function index(Request $req){

    }

    function get_villa(Request $req){
        $data_villa = array();
        $data = $req->all();
        $villa = tbvilla::where([
            'status_villa'  => 'enable'
        ])
        ->orderBy('harga_villa', $data['harga'])
        ->get();
        // dd($data);


        foreach ($villa as $key => $value) {
            if(tbfasilitas_villa::whereIn('id_fasilitas', $data['kategori'])->where([
                'id_villa'  => $value->id_villa
            ])->exists()){
                array_push($data_villa, [
                    'harga'     => $value->harga_villa,
                    'nama'      => $value->nama_villa,
                    'lat'       => $value->latitude,
                    'long'      => $value->longitude,
                    'gambar'    => tbfoto_villa::where('id_villa', $value->id_villa)->get()->toArray(),
                    'id_villa'  => $value->id_villa
                ]);
            }
        }

        return response([
            'status'    => 1,
            'message'   => "berhasil",
            'data'      => $data_villa,
            'wisata'    => $data['wisata'] === 'all' ? "" : tblokasi_wisata::find($data['wisata'])
        ], 200);
    }
}
