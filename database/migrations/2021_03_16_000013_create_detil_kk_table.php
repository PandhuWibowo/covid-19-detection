<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetilKkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detil_kk', function (Blueprint $table) {
            $table->string('id_kk', 20);
            $table->string('nik_keluarga', 20);
            $table->string('status_keluarga', 10);

            // $table->foreign('id_kk')->references('id_kk')->on('kartu_keluarga');
            // $table->foreign('nik_keluarga')->references('nik')->on('citizens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detil_kk');
    }
}
