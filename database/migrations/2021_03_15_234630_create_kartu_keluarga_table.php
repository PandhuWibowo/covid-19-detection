<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluarga', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('id_user', false, true)->length(4)->unsigned();
            $table->string('id_kk', 20);
            $table->primary('id_kk');
            $table->string('nik_kepala_keluarga', 20)->unique();
            $table->string('status_tempat_tinggal', 7);

            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kartu_keluarga');
    }
}
