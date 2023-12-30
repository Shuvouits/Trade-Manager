<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitLossAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profit_loss_account', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->nullable(); 
            $table->string('account_name')->nullable();
            $table->string('date')->nullable();
            $table->string('dr')->nullable();
            $table->string('cr')->nullable();
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
        Schema::dropIfExists('profit_loss_account');
    }
}
