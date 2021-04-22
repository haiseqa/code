<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbfasilitasVillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbfasilitas_villa', function (Blueprint $table) {
            $table->bigIncrements('id_fasilitas_villa');
            $table->string('id_fasilitas',10);
            $table->string('id_villa',10);
            $table->foreign('id_fasilitas')->references('id_fasilitas')->on('tbfasilitas')->onDelete('cascade');
            $table->foreign('id_villa')->references('id_villa')->on('tbvilla')->onDelete('cascade');
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
        Schema::dropIfExists('tbfasilitas_villa');
    }
}
