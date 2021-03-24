<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Database\tbuser;
use App\Database\tbpemilik;
use App\Utils\makeid;

class CreateTbuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbuser', function (Blueprint $table) {
            $table->string('id_user', 10)->primary();
            $table->string('username', 100)->unique();
            $table->enum('role',['admin', 'pemilik','wisatawan']);
            $table->string('password');
            $table->enum('status',['enable', 'disable'])->default('disable');
            $table->timestamps();
        });

        tbuser::create([
            'id_user'   => makeid::createId(10),
            'username'  => 'dika',
            'role'      => 'Admin',
            'status'    => 'enable',
            'password'  => Hash::make('123456')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbuser');
    }
}
