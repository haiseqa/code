<?php

use App\Database\tbfasilitas;
use App\Database\tblokasi_wisata;
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

//API GET VILLA
Route::get('/api/villa/get', 'Page\home_controller@get_villa')->name('api.get.villa');


// Route::group(['middleware' => 'notlogin'], function(){
    Route::get('/login', 'Auth\authController@index')->name('login');
    Route::post('/login', 'Auth\authController@login_post');
    Route::get('/register', 'Auth\authController@register')->name('register');
    Route::post('/register', 'Auth\authController@register_post');
    // Route::get('/form_booking', 'Auth\authController@form_booking')->name('form_booking');
// });

// Route::group(['middleware' => 'login'], function(){
//     Route::get('/logout', 'Auth\authController@logout')->name('logout');

    Route::get('/', function(){
        if(authUser::isadmin()){
            return redirect()->route('admin');
        }
        elseif(authUser::ispemilik()){
            return redirect()->route('pemilik');

        }
        else{
            $fasilitas = tbfasilitas::get();
            $lokasiwisata = tblokasi_wisata::get();
            return view('Page.Pengguna.home', [
                'fasilitas' => $fasilitas,
                'lokasiwisata'  => $lokasiwisata
            ]);
        }

    })->name('home');

    Route::get('/booking','page\pemilik_controller@booking')->name('pemilik.booking');
    Route::post('/booking_post', 'page\pemilik_controller@booking_post')->name('pemilik.booking_post');
    route::get('/detail_villa/{id_villa}', 'page\home_controller@detail_villa')->name('home.detail_villa');

    Route::group(['middleware' => 'login'], function(){
        Route::get('/logout', 'Auth\authController@logout')->name('logout');

    //Vila
    Route::get('/vila/tambah', 'page\pemilik_controller@tambah_vila')->name('pemilik.vila.tambah');
    Route::post('/vila/tambah', 'page\pemilik_controller@tambah_vila_post');
    Route::get('/edit_villa', 'page\pemilik_controller@edit_villa')->name('pemilik.edit_villa');
    Route::post('/edit_villa', 'page\pemilik_controller@edit_villa_post')->name('pemilik.villa.edit');
    Route::get('/pemilik/delete/{id_villa}', 'page\pemilik_controller@delete_villa')->name('pemilik.delete_villa');


    // Route::post('/booking_post', 'page\pemilik_controller@booking_post')->name('pemilik.booking_post');
    // Route::get('/form_booking', 'page\pemilik_controller@form_booking')->name('pemilik.form_booking');

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
        route::get('/pemilik/status/{cmd}', 'page\admin_controller@change_status_pemilik')->name('admin.change_status_pemilik');

        //data villa
        route::get('admin/daftarvilla', 'page\admin_controller@daftarvilla')->name('admin.daftarvilla');
        route::get('/pemilik/villa/status/{cmd}', 'page\admin_controller@change_status_villa')->name('admin.pemilik.status');
        route::get('admin/detail_villa/{idvilla}', 'page\admin_controller@detail_villa')->name('admin.detail_villa');
        route::get('admin/gambar/{idvilla}', 'page\admin_controller@galeri')->name('admin.galeri');
        // route::get('/profile_admin', 'page\admin_controller@profile_admin')->name('admin.profile_admin');
        // route::get('/profile_admin', 'page\admin_controller@profile_admin_post');
        // route::get('/profile_admin/password', 'page\admin_controller@profile_password_post')->name('admin.profile_profile.password');
        route::get('/fasilitas','page\fasilitas_controller@fasilitas')->name('admin.fasilitas');
        route::post('/fasilitas', 'page\fasilitas_controller@tambah_fasilitas')->name('admin.tambah_fasilitas');
        route::get('/fasilitas/edit/{idfasilitas}', 'page\fasilitas_controller@edit_fasilitas')->name('admin.edit_fasilitas');
        route::post('/fasilitas/edit/{idfasilitas}', 'page\fasilitas_controller@postedit_fasilitas');
        route::get('fasilitas/delete/{id_fasilitas}', 'page\fasilitas_controller@delete_fasilitas')->name('admin.fasilitas_delete');

        //lokasi wisata

        route::get('/lokasi_wisata', 'page\lokasiwisata_controller@lokasi_wisata')->name('admin.lokasi_wisata');
        route::post('/lokasi_wisata', 'page\lokasiwisata_controller@tambah_lokasi_wisata')->name('admin.tambah.lokasi_wisata');
        route::get('/lokasi_wisata/edit/{idlokasi_wisata}', 'page\lokasiwisata_controller@edit_lokasi_wisata')->name('admin.edit.lokasi_wisata');
        route::post('/lokasi_wisata/edit/{idlokasi_wisata}','page\lokasiwisata_controller@editpost_lokasi_wisata');
        route::get('/lokasi_wisata/delete/{idlokasi_wisata}', 'page\lokasiwisata_controller@delete_lokasi_wisata')->name('admin.delete.lokasi_wisata');


    });

    Route::group([
        'prefix'        => 'pemilik',
        'middleware'    => ['pemilik']
    ], function(){
        Route::get('/', 'page\pemilik_controller@dashboard')->name('pemilik');

        Route::get('/daftarvilla', 'page\pemilik_controller@daftarvilla')->name('pemilik.daftarvilla');

        Route::get('/gambar/{idvilla}','page\pemilik_controller@galeri')->name('pemilik_villa.galeri');
        Route::get('/delete/gambar/{idfoto}', 'page\pemilik_controller@deletegaleri')->name('pemilik.deletegaleri');
        // Route::get('/tambah/{idfoto}', 'page\pemilik_controller@tambahgaleri')->name('pemilik.tambahgaleri');
        Route::post('/tambah/{idfoto}', 'page\pemilik_controller@tambahgaleri')->name('pemilik.tambahgaleri');

        // Route::get('/registrasi_villa', 'page\pemilik_controller@registrasi_villa')->name('pemilik.registrasi_villa');
        Route::get('/profile_pemilik', 'page\pemilik_controller@profile_pemilik')->name('pemilik.profile_pemilik');
        Route::post('/profile_pemilik', 'page\pemilik_controller@profile_pemilik_post');
        Route::post('/profile_pemilik/password', 'page\pemilik_controller@profile_password_post')->name('pemilik.profile_profile.password');
        Route::get('/detail_villa', 'page\pemilik_controller@detail_villa')->name('pemilik.detail_villa');

        Route::get('villa/booking/status/{idbooking}/{status}', 'page\pemilik_controller@change_status')->name('pemilik.change_status');

    });

    Route::group([
        'prefix'        => 'wisatawan',
        'middleware'    => ['wisatawan']
    ], function(){
        //start route wisatawan
    });
});


