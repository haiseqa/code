<?php

namespace App\Http\Controllers\page;

use App\Database\tbfasilitas_villa;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbfoto_villa;
use App\Database\tblokasi_wisata;
use App\Database\tbvilla;
use App\Database\tbfasilitas;
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
        ->where('nama_villa', 'Like', '%'. ($data['search'] === 'all' ? "". '%' : $data['search']. '%'))
        ->orderBy('harga_villa', $data['harga'])->get();
        // dd($data);

        // if($data['search'] !== 'all'){
        //     $villa->where('nama_villa', 'LIKE', '%'. $data['search']. '%');
        // }

        // $villa->get();
        // dd($villa);

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
    function detail_villa(Request $req, $id_villa){
        $villa = tbvilla::join('tbpemilik', 'tbpemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->select('tbvilla.*')
        ->where([
            'tbvilla.id_villa' => $id_villa
        ])->first();
        // dd($villa);

        $image = tbfoto_villa::where([
            'id_villa'  => $villa->id_villa
        ])->get();

        // dd($image);

        $fasilitas_pemilik = tbfasilitas_villa::
        join('tbfasilitas', 'tbfasilitas.id_fasilitas', '=', 'tbfasilitas_villa.id_fasilitas')
        ->select('tbfasilitas.nama_fasilitas')
        ->where([
            'id_villa'  => $villa->id_villa
        ])->get();
        // dd($fasilitas_pemilik);

        return view('Page.Pengguna.detail_villa', [
            'villa'     => $villa,
            'image'     => $image,
            'fasilitas' => $fasilitas_pemilik
        ]);
    }
}
