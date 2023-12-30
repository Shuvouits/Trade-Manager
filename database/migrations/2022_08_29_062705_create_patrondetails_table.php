<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrondetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrondetails', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('patron_status');
            $table->string('patron_category');
            $table->string('patron_name');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('contact_number');
            $table->string('date_introducing');
            $table->string('transaction_limit');
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
        Schema::dropIfExists('patrondetails');
    }
}
