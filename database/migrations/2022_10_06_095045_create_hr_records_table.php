<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_records', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('p_payroll');
            $table->string('p_advance');
            $table->string('p_loan');
            $table->string('a_payroll');
            $table->string('a_advance');
            $table->string('a_loan');
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
        Schema::dropIfExists('hr_records');
    }
}
