<?php

namespace App\Http\Controllers\page;

use App\Database\tbadmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbfoto_villa;
use App\Database\tbfasilitas_villa;
use App\Database\tbfasilitas;
use App\Database\tblokasi_wisata;
use App\Database\tbvilla;
use App\Utils\makeid;
use Illuminate\Support\Facades\Hash;

class admin_controller extends Controller
{
    function dashboard(Request $req){
        $villa      = tbvilla::count();
        $pemilik    = tbpemilik::count();
        $fasilitas   = tbfasilitas::count();
        $wisata     =  tblokasi_wisata::count();

        return view('Page.admin.dashboard', [
            'villa'     => $villa,
            'pemilik'   => $pemilik,
            'fasilitas' => $fasilitas,
            'wisata'    => $wisata

        ]);
    }

    function pemilik(){
        $pemilik = tbpemilik::get();
        return view('Page.admin.pemilik',[
            'pemilik'=>$pemilik
        ]);
    }

    function change_status_pemilik(Request $req, $cmd){
        $pemilik = tbpemilik::find($req->input('id_pemilik'))->update([
            'status_pemilik'    =>$cmd
        ]);
        if($pemilik){
            return back()->with('message', "Pemilik Berhasi Disable");
        }
        return back()->with('message', "Pemilik Gagal Disable");
    }

    function editpemilik($idpemilik, Request $req){
        $pemilik = tbpemilik::find($idpemilik);
        return view('Page.admin.formpemilik', [
            'editpemilik'=>$pemilik
        ]);
    }

    function posteditpemilik($idpemilik, Request $req){
        $updatepemilik = tbpemilik::find($idpemilik)->update([
            'nama'=> $req->input('nama'),
            'jenis_kelamin'=> $req->input('gender'),
            'alamat'=> $req->input('address'),
            'nohp'=> $req->input('number'),
            'email'=> $req->input('email')
        ]);

        if($updatepemilik){
            return redirect()->route('admin.pemilik')->with('message','your data finish update');
        }
        return back()->with('message','error');
    }

    function deletepemilik($id_user, Request $req){
        $delete = tbuser::find($id_user)->delete();
        if($delete){
            return back()->with('message','berhasil dihapus');
        }
        return back()->with('message','gagal dihapus');

    }

    function daftarvilla(){
        $villa = tbvilla::join('tbpemilik as pemilik', 'pemilik.id_pemilik', '=', 'tbvilla.id_pemilik')
        ->select('tbvilla.*')
        ->get();
        //  dd($villa);
        return view('Page.admin.daftarvilla',[
            'villa'     =>$villa
        ]);
    }

    function change_status_villa(Request $req, $cmd){
        $villa = tbvilla::find($req->input('id_villa'))->update([
            'status_villa'    =>$cmd
        ]);
        if($villa){
            return back()->with('message', "Data Kos Berhasil Diperbarui");
        }
        return back()->with('message', "Data Kos Gagal Diperbarui");
    }

    function profile_admin(Request $req){
        $user = tbadmin::join('tbuser', 'tbuser.id_user', '=', 'tbadmin.id_user')
        ->select('tbadmin.*', 'tbuser.username')
        ->where([
            'tbuser.id_user' =>$req->session()->get('iduser')
        ])->first();

        return view('Page.admin.profile_admin', [
            'user' =>$user
        ]);
    }

    function profile_admin_post (Request $req){
        $data = $req->all();
        $data_update = array();
        if($req->hasFile('fileProfile')){
            $imageName = makeid::createId(10).".".$req->file('fileProfile')->extension();
            $path = Storege::disk('public')->putFileAS('profile', $req->file('fileProfile'), $imageName);
            $data_update['foto_profile'] = $path;
            $req->session()->put([
                'foto_profile' =>$path
            ]);
        }
        $data_update['nama'] = $data['nama'];
        $data_update['nohp'] = $data['nohp'];
        $data_update['alamat'] = $data['alamat'];

        $admin = tbadmin::find($data['idadmin'])->update($data_update);
        if($admin){
            return back()->with('message', 'Profile Berhasil Diupdate');
        }
        return back()->with('Profile Gagal Diupdate');
    }

    function profile_password_post(Request $req){
        $user = tbuser::find($req->input('iduser'));
        if(!Hash::check($req->input('oldPassword'), $user->password)){
            return redirect()->route(admin.profile_admin)->with('message','Password Lama Salah');
        }
        $user->update([
            'password'  =>Hash::make($req->input('newPassword'))
        ]);

        if($user){
            return redirect()->route('admin.profile_admin')->with('message', 'Password Berhasil Diganti');
        }
        return redirect()->route('admin.profile_admin')->with('message', 'Password Gagal Diganti');
    }

    function detail_villa(Request $req, $idvilla){
        $villa = tbvilla::find($idvilla);
        $image = tbfoto_villa::where([
            'id_villa'  => $villa->id_villa
        ])->get();

        $fasilitas_pemilik = tbfasilitas_villa::
        join('tbfasilitas', 'tbfasilitas.id_fasilitas', '=', 'tbfasilitas_villa.id_fasilitas')
        ->select('tbfasilitas.nama_fasilitas')
        ->where([
            'id_villa'  => $villa->id_villa
        ])->get();

        return view('Page.admin.detail_villa', [
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
        return view('Page.admin.gambar',[
            'image'     => $image,
            'idvilla'   => $idvilla
        ]);
    }

}
