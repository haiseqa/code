<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Database\tbvilla;
use App\Utils\makeid;
use Hash;

class authController extends Controller
{
    function index(){
        return view('login');
    }

    function login_post(Request $req){
        $user = tbuser::where([
            'username'  => $req->input('username')
        ])->first();

        if(empty($user)){
            return back()->with('message', 'Username Atau Password Salah');
        }

        $pemilik = tbpemilik::where([
            'id_user'   =>$user->id_user
        ])->first();

        if(!empty($pemilik)){
            if($pemilik->status !== 'enable'){
                return back()->with('message', 'User sudah dinonaktifkan');
            }
        }

        if(!Hash::check($req->input('password'), $user->password)){
            return back()->with('message', 'Username Atau Password Salah');
        }

        $req->session()->put([
            'login'     => true,
            'iduser'    => $user->id_user,
            'role'      => $user->role,
            'status'    => $user->status
        ]);

        if($user->role === 'pemilik'){
            $pemilik = tbpemilik::where([
                'id_user'   => $user->id_user
            ])->first();

            $villa = tbvilla::where([
                'id_pemilik'    => $pemilik->id_pemilik
            ])->count();
            $req->session()->put([
                'villa'     => $villa > 0 ? true : false,
                'idpemilik' => $pemilik->id_pemilik
            ]);

            $req->session()->put([
                'nama'      => $pemilik->nama,
                'email'     => $pemilik->email
            ]);

        }
        return redirect()->route('home');

        // return back();
    }

    function register(Request $req){
        return view('register');
    }

        function register_post(Request $req){
            $this->validate($req, [
                'nama'      => 'required|max:100',
                'username'  => 'required|max:100',
                'gender'    => 'required',
                'address'   => 'required',
                'email'     => 'required',
                'number'    => 'required',
                'password'  => 'required'
            ]);
            $data = $req->all();
            if(tbpemilik::where([
                'email' => $data['email']
            ])->exists()) {
                return back()->with('message', 'email sudah digunakan');
            }
            $iduser = makeid::createid(10);
            $idpemilik = makeid::createid(10);
            // dd($req->all());
            tbuser::create([
                'id_user'   =>$iduser,
                'username'  =>$data['username'],
                'role'      =>'pemilik',
                'password'  =>Hash::make($data['password'])
            ]);

            $pemilik = tbpemilik::create([
                'id_pemilik'    =>$idpemilik,
                'id_user'       =>$iduser,
                'nama'          =>$data['nama'],
                'jenis_kelamin' =>$data['gender'],
                'alamat'        =>$data['address'],
                'email'         =>$data['email'],
                'nohp'          =>$data['number']
            ]);
            if($pemilik){
                return redirect()->route('login')->with('message','Berhasil di daftarkan');
            }
            return back()->with('message','Gagal di daftarkan');

        }
        function logout(Request $req){
            $req->session()->flush();
            return redirect()->route('home');
        }
}
