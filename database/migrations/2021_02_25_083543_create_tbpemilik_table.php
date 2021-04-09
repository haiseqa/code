<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Utils\makeid;

class CreateTbpemilikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbpemilik', function (Blueprint $table) {
            $table->string('id_pemilik',10)->primary();
            $table->string('id_user',10);
            $table->foreign('id_user')->references('id_user')->on('tbuser')->onDelete('cascade');
            $table->string('nama');
            $table->string('jenis_kelamin',0,1);
            $table->string('alamat');
            $table->string('email')->unique();
            $table->string('nohp',12);
            $table->string('foto_profile')->nullable();
            $table->timestamps();
        });

        $idpemilik = makeid::createId(10);
        tbuser::create([
            'id_user'    => $idpemilik,
            'username'   => 'ibu',
            'role'       => 'pemilik',
            'password'   => Hash::make('12345678')
        ]);

        tbpemilik::create([
            'id_pemilik'    => makeid::createId(10),
            'id_user'   => $idpemilik,
            'nama'      =>'ibuibu',
            'jenis_kelamin' => '1',
            'alamat' => 'jl batuyang',
            'email'  => 'ibu@gmail.com',
            'nohp'   => '081234567800'

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbpemilik');
    }
}
