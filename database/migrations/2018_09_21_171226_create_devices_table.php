<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();

            $table->string('os')->nullable();
            $table->string('ver')->nullable();
            $table->string('name')->nullable();
            $table->string('model')->nullable();

            $table->string('push_id')->nullable();
            $table->string('push_hb')->nullable()->default('on');
            $table->string('push_upload')->nullable()->default('on');

            $table->dateTime('last_active')->nullable();

            // sendnotify
            // notifyonreport
            // block_mode, unblock, confirm_now

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
        Schema::dropIfExists('devices');
    }
}