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

    Route::group([
        'prefix'        => 'admin',
        'middleware'    => ['admin']
    ], function(){
        route::get('/', 'page\admin_controller@dashboard')->name('admin');
        route::get('/pemilik', 'page\admin_controller@pemilik')->name('admin.pemilik');
        route::get('/pemilik/edit/{idpemilik}','page\admin_controller@editpemilik')->name('admin.pemilik.edit');
        route::post('/pemilik/edit/{idpemilik}','page\admin_controller@posteditpemilik');
        route::get('/pemilik/delete/{id_user}','page\admin_controller@deletepemilik')->name('admin.pemilik.delete');

    });

    Route::group([
        'prefix'        => 'pemilik',
        'middleware'    => ['pemilik']
    ], function(){
        Route::get('/', 'page\pemilik_controller@dashboard')->name('pemilik');

        Route::get('/daftarvilla', 'page\pemilik_controller@daftarvilla')->name('pemilik.daftarvilla');
        Route::get('/registrasi_villa', 'page\pemilik_controller@registrasi_villa')->name('pemilik.registrasi_villa');
    });

    Route::group([
        'prefix'        => 'wisatawan',
        'middleware'    => ['wisatawan']
    ], function(){
        //start route wisatawan
    });
});


