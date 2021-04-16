<?php

namespace App\Http\Controllers\page;

use App\Database\tbfoto_villa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbvilla;
use App\Utils\makeid;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class pemilik_controller extends Controller
{
    function dashboard(){
        return view('Page.pemilik.dashboard');
    }

    function daftarvilla(Request $req){
        $villa = tbvilla::join('tbpemilik as pemilik', 'pemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->select('tbvilla.*')
        ->where([
            'pemilik.id_user'   => $req->session()->get('iduser')
        ])->get();
        //  dd($villa);
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
        $pemilik = tbpemilik::where([
            'id_user'   => $req->session()->get('iduser')
        ])->first();

        if(empty($pemilik)){
            return back()->with('message', 'data pemilik tidak sesuai');
        }
        $id_vila = makeid::createId(10);

        $villa = tbvilla::create([
            'id_villa'      => $id_vila,
            'id_pemilik'    => $pemilik->id_pemilik,
            'nama_villa'    => $data['nama'],
            'alamat_villa'  => $data['alamat'],
            'harga_villa'   => $data['harga'],
            'deskripsi'     => $data['deskripsi'],
            'longitude'     => $data['longitude'],
            'latitude'      => $data['latitude'],
            'status'        => $data['status']
        ]);

        //upload gambar
        for ($i=0; $i < sizeof($data['file']); $i++) {
            $imageName = makeid::createId(10).".".$data['file'][$i]->extension();
            $path = Storage::disk('public')->putFileAs('img_vila', $data['file'][$i], $imageName);
            tbfoto_villa::create([
                'id_villa'   => $id_vila,
                'path'       => $path
            ]);
        }


        if($villa){
            tbuser::find($req->session()->get('iduser'))->update([
                'status'    => 'enable'
            ]);
            $req->session()->put([
                'status'    => 'enable'
            ]);
            return redirect()->route('pemilik')->with('message', 'data villa berhasil ditambahkan');
        }
        return back()->with('message', 'data villa gagal ditambahkan');
    }

    function profile_pemilik(Request $req){
        $user = tbpemilik::join('tbuser', 'tbuser.id_user', '=', 'tbpemilik.id_user')
        ->select('tbpemilik.*', 'tbuser.username')
        ->where([
            'tbuser.id_user' =>$req->session()->get('iduser')
        ])->first();
        // dd($user);
        return view('Page.pemilik.profile_pemilik', [
            'user' =>$user
        ]);
    }

    function profile_pemilik_post (Request $req){
        // dd($req->all());
        $data = $req->all();
        $data_update = array();
        if($req->hasFile('fileProfile')){
            $imageName = makeid::createId(10).".".$req->file('fileProfile')->extension();
            $path = Storage::disk('public')->putFileAs('profile', $req->file('fileProfile'), $imageName);
            $data_update['foto_profile'] = $path;
            $req->session()->put([
                'foto_profile'  => $path
            ]);
        }
        $data_update['nama'] = $data['nama'];
        $data_update['nohp'] = $data['nohp'];
        $data_update['alamat'] = $data['alamat'];

        $pemilik = tbpemilik::find($data['idpemilik'])->update($data_update);
        if($pemilik){
            return back()->with('message', 'Profile Berhasil Diupdate');
        }
        return back()->with('Profile Gagal Diupdate');
    }

    function profile_password_post(Request $req){
        $user = tbuser::find($req->input('iduser'));
        if(!Hash::check($req->input('oldPassword'), $user->password)){
            return redirect()->route(pemilik.profile_pemilik)->with('message', 'Password Lama Salah');
        }
        $user->update([
            'password'  =>Hash::make($req->input('newPassword'))
        ]);

        if($user){
            return redirect()->route('pemilik.profile_pemilik')->with('message', 'Password Berhasil Diganti');
        }
        return redirect()->route('pemilik.profile_pemilik')->with('message', 'Password Gagal Diganti');

    }
}
