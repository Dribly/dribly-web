<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterSensorModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->int('owner')->unsigned();
            $table->int('garden')->unsigned();
            $table->string('uid')->unique();
            $table->string('description');
            $table->enum('status', array('deleted', 'inactive', 'active'));
            $table->rememberToken();
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
        Schema::dropIfExists('water_sensors');
    }
}
