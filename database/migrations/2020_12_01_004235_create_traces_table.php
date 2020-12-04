<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traces', function (Blueprint $table) {
            $table->increments('id');

            $table->string('event_id')->index();
            $table->string('lat');
            $table->string('lng');
            $table->string('address');

            /*
                timestamp 的 2038 年问题 :
                数据范围是 1970-01-01 00:00:01 UTC ~ 2038-01-19 03:14:07 UTC
                大于 2038-01-19 03:14:07 的值数据库是无法存储的，会变为 0000-00-00 00:00:00
            */
            $table->timestamps();
            // $table->timestamp('created_at');
            // $table->timestamp('updated_at');

            /*
                dateTime 的存储范围是 1000-01-01 00:00:00 ~ 9999-12-31 23:59:59
            */
            // $table->dateTime('created_at');
            // $table->dateTime('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traces');
    }
}