<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCovidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_covid', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('id_user', false, true)->length(4)->unsigned();
            $table->increments('id_pendataan', 6);
            $table->date('tgl_pendataan');
            $table->date('tgl_terinfeksi');
            $table->string('nik', 20);
            $table->string('status_virus');
            $table->string('status_penanganan');
            $table->date('tgl_sembuh')->nullable();
            $table->string('id_kk', 20);

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_kk')->references('id_kk')->on('kartu_keluarga');
            $table->foreign('nik')->references('nik')->on('citizens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_covid');
    }
}
