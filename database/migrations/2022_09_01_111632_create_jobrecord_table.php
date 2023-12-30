<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobrecord', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->string('date');
            $table->string('hr');
            $table->string('absent');
            $table->string('work_day');
            $table->string('other_benifit');
            $table->string('other_deduction');
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
        Schema::dropIfExists('jobrecord');
    }
}
