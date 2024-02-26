<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('letter_no', 200)->unique();
            $table->date('letter_date');
            $table->string('letter_char', 200)->nullable();
            $table->string('letter_name', 200)->nullable();
            $table->string('sender_type', 100)->nullable();
            $table->string('sender_name', 200)->nullable();
            $table->string('pengirim_unit_internal', 200)->nullable();
            $table->foreignId('employees_id_destination')->references('id')->on('employees')->onDelete('Restrict')->onUpdate('Cascade');
            $table->string('regarding', 200)->nullable();
            $table->string('letter_file', 255)->nullable();
            $table->string('letter_type', 200)->nullable();
            $table->integer('status_condition')->default(0);
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
        Schema::dropIfExists('letters');
    }
}
