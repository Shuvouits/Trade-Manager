<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_mode')->nullable();
            $table->string('referrence')->nullable();
            $table->string('project_id')->nullable();
            $table->string('project_name')->nullable();
            $table->string('account_id')->nullable();
            $table->string('account_name')->nullable();
            $table->string('sub_account_id')->nullable();
            $table->string('sub_account_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('bank_name')->nullable();
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
        Schema::dropIfExists('voucher');
    }
}
