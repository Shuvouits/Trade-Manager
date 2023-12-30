<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronOpeningBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patron_opening_balance', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('patron_id')->nullable();
            $table->string('patron_name')->nullable();
            $table->string('debit_balance')->nullable();
            $table->string('credit_balance')->nullable();
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
        Schema::dropIfExists('patron_opening_balance');
    }
}
