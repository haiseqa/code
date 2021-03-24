<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbwisatawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbwisatawan', function (Blueprint $table) {
            $table->string('id_wisatawan',10)->primary();
            $table->string('nama');
            $table->string('jenis_kelamin',0,1);
            $table->string('alamat');
            $table->string('email')->unique();
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
        Schema::dropIfExists('tbwisatawan');
    }
}
