<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('name');
            $table->string('birth_date');
            $table->string('parent_name');
            $table->string('permanent_address');
            $table->string('contact_address');
            $table->string('contact_number');
            $table->string('qualification');
            $table->string('position');
            $table->string('joining_date');
            $table->string('joining_point');
            $table->string('hr_id');
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
        Schema::dropIfExists('hr');
    }
}
