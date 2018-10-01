<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iccid')->unique();
            $table->integer('user_id')->index();
            $table->integer('camera_id')->nullable();

            $table->string('status')->nullable();
            $table->float('points')->default(0);
            $table->float('points_used')->default(0);

            $table->integer('sms')->default(0);
            $table->integer('sms_sent')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
