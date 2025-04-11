<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCutiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuti', function (Blueprint $table) {
            $table->increments('id_cuti');
            $table->string('nip');
            $table->foreign('nip')->references('nip')->on('karyawan');
            $table->string('jenis_cuti');
            $table->date('mulai');
            $table->date('hingga');
            $table->string('alasan');
            $table->date('tgl_pengajuan');
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
        Schema::dropIfExists('cuti');
    }
}
