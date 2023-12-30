<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_balance', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->nullable();
            $table->string('transaction_mode')->nullable();
            $table->string('accounts_name')->nullable();
            $table->string('dr')->nullable();
            $table->string('cr')->nullable();
            $table->string('final_dr')->nullable();
            $table->string('final_cr')->nullable();
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
        Schema::dropIfExists('trial_balance');
    }
}
