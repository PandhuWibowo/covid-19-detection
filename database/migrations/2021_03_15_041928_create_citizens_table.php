<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->integer('id_user', false, true)->length(4)->unsigned();
            $table->string('nik', 20);
            $table->primary('nik');
            $table->string('nama', 30);
            $table->text('alamat', 50);
            $table->string('no_telp', 12);
            $table->string('pendidikan', 5);
            $table->string('pekerjaan', 15);
            $table->string('status_pernikahan', 10);
            $table->date('tgl_lahir');

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
        Schema::dropIfExists('citizens');
    }
}
