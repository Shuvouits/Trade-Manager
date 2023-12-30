<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('project_owner');
            $table->string('project_type');
            $table->string('date_start');
            $table->string('date_complete');
            $table->string('project_name');
            $table->string('project_incharge');
            $table->string('project_address');
            $table->string('contact');
            $table->string('project_referrence');
            $table->string('project_value');
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
        Schema::dropIfExists('project');
    }
}
