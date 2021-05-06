<?php

namespace App\Http\Controllers\page;

use App\Database\tbbooking;
use App\Database\tbfasilitas;
use App\Database\tbfasilitas_villa;
use App\Database\tbfoto_villa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbvilla;
use App\Utils\makeid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class pemilik_controller extends Controller
{
    function dashboard(Request $req){
        $villa = tbvilla::join('tbpemilik', 'tbpemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->select('tbvilla.*')
        ->where([
            'tbpemilik.id_user' => $req->session()->get('iduser')
        ])->first();
        return view('Page.pemilik.dashboard',[

            'villa'     => $villa,
        ]);
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
        $fasilitas = tbfasilitas::get();
        return view('Page.pemilik.tambah_villa',[
            'data_villa'    => $villa,
            'fasilitas'     => $fasilitas
        ]);
    }

    function edit_villa(Request $req){
        $villa = tbvilla::where([
            'id_pemilik' => $req->session()->get('idpemilik')
        ])->first();

        $fasilitas = tbfasilitas_villa::join('tbfasilitas', 'tbfasilitas.id_fasilitas', '=', 'tbfasilitas_villa.id_fasilitas')
        ->where([
            'tbfasilitas_villa.id_villa'    => $villa->id_villa
        ])->get();

        $fasilitas_data = tbfasilitas::whereNotIn('id_fasilitas', tbfasilitas_villa::where([
            'id_villa'  => $villa->id_villa
        ])->select('id_fasilitas')->get()->toArray())->get();

        return view('Page.pemilik.edit_villa',[
            'villa'             => $villa,
            'fasilitas'        => $fasilitas,
            'fasilitas_data'    => $fasilitas_data
        ]);
    }

    function edit_villa_post(Request $req){
        // dd($req->all());
        $data = $req->all();
        $villa = tbvilla::where([
            'id_pemilik'    => $req->session()->get('idpemilik')
        ])->first();
        $id_villa = $villa->id_villa;

        $villa->update([
            'nama_villa'        => $data['nama'],
            'alamat_villa'      => $data['alamat'],
            'harga_villa'       => $data['harga'],
            'deskripsi'        => $data['deskripsi_villa'],
            'latitude'          => $data['latitude'],
            'longitude'         => $data['longitude']
        ]);

        $del_fasilitas  = tbfasilitas_villa::where([
            'id_villa'  => $id_villa
        ])->delete();
        foreach ($data['fasilitas'] as $key => $value){
            tbfasilitas_villa::create([
                'id_fasilitas'  => $value,
                'id_villa'      => $id_villa
            ]);
        }
        if($villa){
            return redirect()->route('pemilik.detail_villa',[$id_villa])->with('message', 'berhasil');
        }
        return back()->with('message','gagal');

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
        $id_vila = makeid::createId(10);

        $villa = tbvilla::create([
            'id_villa'      => $id_vila,
            'id_pemilik'    => $pemilik->id_pemilik,
            'nama_villa'    => $data['nama'],
            'alamat_villa'  => $data['alamat'],
            'harga_villa'   => str_replace('.', '', $data['harga']),
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

        foreach ($data['fasilitas'] as $key => $value) {
            tbfasilitas_villa::firstOrCreate([
                'id_villa'  => $id_vila,
                'id_fasilitas'  => $value
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

    function delete_villa(Request $req, $id_villa){
        $delete = tbvilla::find($id_villa)->delete();
        if($delete){
            return back()-> with('message', 'Villa Berhasil Dihapus');
        }
            return back()-> with('message', 'Villa Gagal Dihapus');
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

    function detail_villa(Request $req){
        $villa = tbvilla::join('tbpemilik', 'tbpemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->select('tbvilla.*')
        ->where([
            'tbpemilik.id_user' => $req->session()->get('iduser')
        ])->first();
        // dd($villa);

        $image = tbfoto_villa::where([
            'id_villa'  => $villa->id_villa
        ])->get();

        $fasilitas_pemilik = tbfasilitas_villa::
        join('tbfasilitas', 'tbfasilitas.id_fasilitas', '=', 'tbfasilitas_villa.id_fasilitas')
        ->select('tbfasilitas.nama_fasilitas')
        ->where([
            'id_villa'  => $villa->id_villa
        ])->get();

        return view('Page.pemilik.detail_villa', [
            'villa'     => $villa,
            'image'     => $image,
            'fasilitas' => $fasilitas_pemilik
        ]);
    }
//data Galery
    function galeri(Request $req, $idvilla){
        $image = tbfoto_villa::where([
            'id_villa'      =>$idvilla
        ])->get();
        // dd($image);
        return view('Page.pemilik.gambar',[
            'image'     => $image,
            'idvilla'   => $idvilla
        ]);
    }

    function tambahgaleri(Request $req, $idvilla){
        if(!$req->hasFile('file')){
            return redirect()->route('pemilik_villa.galeri', [$idvilla])->with('message', 'Invalid Image');
        }
        $data = $req->all();
        for($i=0; $i < sizeof($data['file']); $i++){
            $imageName = makeid::createId(10).".".$data['file'][$i]->extension();
            $path = Storage::disk('public')->putFileAs('img_villa', $data['file'][$i], $imageName);
            tbfoto_villa::create([
                'id_villa'      => $idvilla,
                'path'          => $path
            ]);
        }
        return redirect()->route('pemilik_villa.galeri', [$idvilla])->with('messsage', 'Gambar Berhasil Ditambah');
    }

    function deletegaleri(Request $req, $id_foto){
        $delete = tbfoto_villa::find($id_foto)->delete();
        if($delete){
            return back()-> with('message', 'Gambar Berhasil Dihapus');
        }
        return back()-> with('message', 'Gambar Gagal Dihapus');
    }

    function booking(Request $req){
        // dd($req->all());
        $user = tbuser::find($req->session()->get('iduser'));
        $pemilik = tbpemilik::where([
            'id_user'   => $user->id_user
        ])->first();
        $villa = tbvilla::where([
            'id_pemilik'    => $pemilik->id_pemilik
        ])
        ->select('id_villa')
        ->get()->toArray();
        $booking = tbbooking::whereIn('id_villa', $villa)->get();
        // dd($booking);
        return view('Page.pemilik.daftar_booking',[
            'boooking'   =>$booking
        ]);
    }

    function booking_post(Request $req){
        $data = $req->all();

        $boooking = tbbooking::create([
            'id_booking'            => makeid::createId(10),
            'id_villa'              => $data['id_villa'],
            'nama_booking'          => $data['nama'],
            'Alamat'                => $data['alamat'],
            'email'                 => $data['email'],
            'nohp'                  => $data['nohp'],
            'waktu_booking'         => $data['waktubooking'],
            'status_booking'        => "0"
        ]);
        if($boooking){
            return back()->with('message', 'Berhasil Booking');
        }
        return back()->with('message', 'Gagal Booking');
    }

    // function form_booking(Request $req){
    //     return view('Page.Pengguna.form_booking');
    // }
}
