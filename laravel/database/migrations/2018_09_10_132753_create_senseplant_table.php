<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSenseplantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senseplant', function (Blueprint $table) {
            $table->increments('id_plants');
            $table->string('name');
            $table->integer('ideal_humidity');
            $table->integer('ideal_temprature');
            $table->integer('ideal_sunhours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('senseplant');
    }
}
