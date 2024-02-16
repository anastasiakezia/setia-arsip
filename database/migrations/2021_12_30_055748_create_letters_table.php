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
            $table->id();
            $table->string('letter_no')->unique();
            $table->date('letter_date');
            $table->string('letter_char');
            $table->string('sender_name');
            // $table->date('date_received');
            // $table->string('agenda_no');
            $table->string('regarding');
            $table->string('disposisi');
            $table->foreignId('department_id');
            // $table->foreignId('sender_id');
            $table->string('letter_file');
            $table->string('letter_type');
            $table->integer('status_condition');
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
