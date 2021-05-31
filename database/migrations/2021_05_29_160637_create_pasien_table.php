<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->enum('jenis_obat', ['Racikan', 'Non-Racikan']);
            $table->enum('jenis_pasien', ['BPJS', 'Umum', 'Perusahaan']);
            $table->boolean('status')->nullable();
            $table->timestamp('waktu_selesai')->nullable();
            $table->timestamp('waktu_diambil')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
}
