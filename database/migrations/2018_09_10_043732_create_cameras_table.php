<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->increments('id'); // camera_id

            $table->string('module_id');    // iemi
            $table->string('iccid');
            $table->string('model_id');

            /* status */
            // $table->string('battery');
            // $table->string('signal_value');
            // $table->string('card_space');
            // $table->string('card_size');
            // $table->string('temperature');
            // $table->string('dsp_version');
            // $table->string('mcu_version');

            /* settings */


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
        Schema::dropIfExists('cameras');
    }
}
