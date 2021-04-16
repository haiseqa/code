<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbfotoVillaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbfoto_villa', function (Blueprint $table) {
            $table->bigIncrements('id_foto_villa');
            $table->string('id_villa');
            $table->foreign('id_villa')->references('id_villa')->on('tbvilla')->onDelete('cascade');
            $table->string('path');
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
        Schema::dropIfExists('tbfoto_villa');
    }
}
