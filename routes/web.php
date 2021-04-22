<?php

use Illuminate\Support\Facades\Route;
use App\Utils\authUser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'notlogin'], function(){
    Route::get('/login', 'Auth\authController@index')->name('login');
    Route::post('/login', 'Auth\authController@login_post');
    Route::get('/register', 'Auth\authController@register')->name('register');
    Route::post('/register', 'Auth\authController@register_post');
});

Route::group(['middleware' => 'login'], function(){
    Route::get('/logout', 'Auth\authController@logout')->name('logout');

    Route::get('/', function(){
        if(authUser::isadmin()){
            return redirect()->route('admin');
        }
        elseif(authUser::ispemilik()){
            return redirect()->route('pemilik');

        }
        elseif(authUser::iswisatawan()){

        }
    })->name('home');

    //Vila
    Route::get('/vila/tambah', 'page\pemilik_controller@tambah_vila')->name('pemilik.vila.tambah');
    Route::post('/vila/tambah', 'page\pemilik_controller@tambah_vila_post');
    Route::post('/edit_villa', 'page\pemilik_controller@edit_villa_post')->name('pemilik.villa.edit');

    Route::group([
        'prefix'        => 'admin',
        'middleware'    => ['admin']
    ], function(){
        route::get('/', 'page\admin_controller@dashboard')->name('admin');

        //data pemilik
        route::get('/pemilik', 'page\admin_controller@pemilik')->name('admin.pemilik');
        route::get('/pemilik/edit/{idpemilik}','page\admin_controller@editpemilik')->name('admin.pemilik.edit');
        route::post('/pemilik/edit/{idpemilik}','page\admin_controller@posteditpemilik');
        route::get('/pemilik/delete/{id_user}','page\admin_controller@deletepemilik')->name('admin.pemilik.delete');

        //data villa
        route::get('admin/daftarvilla', 'page\admin_controller@daftarvilla')->name('admin.daftarvilla');
        route::get('/pemilik/villa/status/{cmd}', 'page\admin_controller@change_status_villa')->name('admin.pemilik.status');
        route::get('admin/detail_villa/{idvilla}', 'page\admin_controller@detail_villa')->name('admin.detail_villa');
        // route::get('/profile_admin', 'page\admin_controller@profile_admin')->name('admin.profile_admin');
        // route::get('/profile_admin', 'page\admin_controller@profile_admin_post');
        // route::get('/profile_admin/password', 'page\admin_controller@profile_password_post')->name('admin.profile_profile.password');
        route::get('/fasilitas','page\fasilitas_controller@fasilitas')->name('admin.fasilitas');
        route::post('/fasilitas', 'page\fasilitas_controller@tambah_fasilitas')->name('admin.tambah_fasilitas');
        route::get('/fasilitas/edit/{idfasilitas}', 'page\fasilitas_controller@edit_fasilitas')->name('admin.edit_fasilitas');
        route::post('/fasilitas/edit/{idfasilitas}', 'page\fasilitas_controller@postedit_fasilitas');

    });

    Route::group([
        'prefix'        => 'pemilik',
        'middleware'    => ['pemilik']
    ], function(){
        Route::get('/', 'page\pemilik_controller@dashboard')->name('pemilik');

        Route::get('/daftarvilla', 'page\pemilik_controller@daftarvilla')->name('pemilik.daftarvilla');

        Route::get('/gambar/{idvilla}','page\pemilik_controller@galeri')->name('pemilik_villa.galeri');
        Route::get('/delete/{idfoto}', 'page\pemilik_controller@deletegaleri')->name('pemilik.deletegaleri');
        // Route::get('/tambah/{idfoto}', 'page\pemilik_controller@tambahgaleri')->name('pemilik.tambahgaleri');
        Route::post('/tambah/{idfoto}', 'page\pemilik_controller@tambahgaleri')->name('pemilik.tambahgaleri');

        Route::get('/registrasi_villa', 'page\pemilik_controller@registrasi_villa')->name('pemilik.registrasi_villa');
        Route::get('/profile_pemilik', 'page\pemilik_controller@profile_pemilik')->name('pemilik.profile_pemilik');
        Route::post('/profile_pemilik', 'page\pemilik_controller@profile_pemilik_post');
        Route::post('/profile_pemilik/password', 'page\pemilik_controller@profile_password_post')->name('pemilik.profile_profile.password');
        Route::get('/detail_villa', 'page\pemilik_controller@detail_villa')->name('pemilik.detail_villa');

    });

    Route::group([
        'prefix'        => 'wisatawan',
        'middleware'    => ['wisatawan']
    ], function(){
        //start route wisatawan
    });
});


