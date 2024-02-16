<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDinasLuarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinas_luars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas');
            $table->string('jabatan');
            $table->string('unit');
            $table->string('surat_tugas');
            $table->string('laporan_dinas_luar');
            $table->string('dokumen_lain');
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
        Schema::dropIfExists('dinas_luars');
    }
}
