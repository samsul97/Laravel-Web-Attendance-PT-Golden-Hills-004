<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id_absensi');
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('karyawan');
            $table->date('tgl');
            $table->string('in_out');
            $table->timeTz('waktu');
            $table->string('id_shift');
            $table->foreign('id_shift')->references('id_shift')->on('shift');
            $table->string('ketepatan');
            $table->string('lokasi');
            $table->longText('deskripsi');
            $table->string('foto');
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
        Schema::dropIfExists('absensi');
    }
}
