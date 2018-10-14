<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_apis', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->index();
            $table->integer('camera_id')->index();

            $table->string('iemi')->index(); // module_id
            $table->string('iccid')->index();
            //$table->string('model_id');

            $table->string('api');
            $table->integer('type')->nullable();
            $table->json('request')->nullable();
            $table->json('response')->nullable();

            //$table->jsonb('options');

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
        Schema::dropIfExists('log_apis');
    }
}
