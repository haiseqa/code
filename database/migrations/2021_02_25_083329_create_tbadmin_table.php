<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbadmin', function (Blueprint $table) {
            $table->string('id_admin',10)->primary();
            $table->string('id_user',10);
            $table->foreign('id_user')->references('id_user')->on('tbuser')->onDelete('cascade');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kelamin',0,1);
            $table->string('nohp',12);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbadmin');
    }
}
