<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('device_id')->index();
            $table->string('push_id')->nullable();

            $table->string('name')->nullable();
            $table->string('model')->nullable();
            $table->string('os')->nullable();
            $table->string('ver')->nullable();

            $table->integer('change')->default(0); // change count for push_id

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
        Schema::dropIfExists('mobiles');
    }
}
