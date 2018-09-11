<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensedataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensedata', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('temprature');
            $table->integer('humidity');
            $table->integer('plant_id');
            $table->integer('sunhours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensedata');
    }
}
