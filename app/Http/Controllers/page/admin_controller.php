<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbvilla;

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
            'status'    =>$cmd
        ]);
        if($villa){
            return back()->with('message', "Data Kos Berhasil Diperbarui");
        }
        return back()->with('message', "Data Kos Gagal Diperbarui");
    }


}
