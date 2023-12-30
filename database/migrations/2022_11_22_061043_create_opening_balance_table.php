<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_balance', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('account_id')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('transaction_mode')->nullable();
           
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
        Schema::dropIfExists('opening_balance');
    }
}
