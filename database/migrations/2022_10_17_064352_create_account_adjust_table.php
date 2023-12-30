<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAdjustTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_adjust', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('voucher_type');
            $table->string('transaction_mode');
            $table->string('account_id');
            $table->string('additional_account_id');
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
        Schema::dropIfExists('account_adjust');
    }
}
