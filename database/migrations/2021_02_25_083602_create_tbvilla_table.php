<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbvillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbvilla', function (Blueprint $table) {
            $table->string('id_villa',10)->primary();
            $table->string('id_pemilik',10);
            $table->foreign('id_pemilik')->references('id_pemilik')->on('tbpemilik')->onDelete('cascade');
            $table->string('nama_villa');
            $table->string('alamat_villa');
            $table->unsignedBigInteger('harga_villa');
            $table->longText('deskripsi');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('status');
            $table->enum('status_villa',['enable', 'disable'])->default('disable');
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
        Schema::dropIfExists('tbvilla');
    }
}
