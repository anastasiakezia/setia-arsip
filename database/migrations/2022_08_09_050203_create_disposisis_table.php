<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id');
            $table->string('asal_unit_disposisi');
            $table->string('asal_karyawan_disposisi');
            $table->string('tujuan_unit_disposisi');
            $table->string('tujuan_karyawan_disposisi');
            $table->string('isi_disposisi');
            $table->string('letter_file')->nullable();
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
        Schema::dropIfExists('disposisis');
    }
}
