<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollbreakupbasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrollbreakupbasic', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('department');
            $table->string('hr');
            $table->string('date');
            $table->string('basic');
            $table->string('house_rent');
            $table->string('medical_allowance');
            $table->string('festival_bonus');
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
        Schema::dropIfExists('payrollbreakupbasic');
    }
}
