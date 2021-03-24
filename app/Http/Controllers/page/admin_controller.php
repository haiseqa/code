<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;

class admin_controller extends Controller
{
    function dashboard(){
        return view('Page.admin.dashboard');
    }

    function pemilik(){
        $pemilik = tbpemilik::get();
        return view('Page.admin.pemilik',[
            'pemilik'=>$pemilik
        ]);
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


}
