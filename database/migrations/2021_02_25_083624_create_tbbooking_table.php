<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbbookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbbooking', function (Blueprint $table) {
            $table->string('id_booking',10)->primary();
            $table->string('id_wisatawan',10);
            $table->string('id_villa',10);
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('tbwisatawan')->onDelete('cascade');
            $table->foreign('id_villa')->references('id_villa')->on('tbvilla');
            $table->datetime('waktu_booking');
            $table->string('status_booking');
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
        Schema::dropIfExists('tbbooking');
    }
}
