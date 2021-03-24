<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblokasiWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblokasi_wisata', function (Blueprint $table) {
            $table->string('id_lokasi_wisata')->primary();
            $table->string('nama_wisata');
            $table->string('longitude');
            $table->string('latidue');
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
        Schema::dropIfExists('tblokasi_wisata');
    }
}
