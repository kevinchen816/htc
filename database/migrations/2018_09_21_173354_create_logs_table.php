<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('camera_id')->index();

            $table->string('api');
            $table->integer('result'); // 0:success, 1:fail

            $table->string('module_id')->unique(); // iemi
            $table->string('iccid')->default('');
            $table->string('model_id')->default('');

            /* status */
            $table->string('battery')->default('');
            $table->integer('signal_value')->default(0);
            $table->string('card_space')->default('');
            $table->string('card_size')->default('');
            $table->string('temperature')->default('');
            // $table->string('dsp_version')->default('');
            // $table->string('mcu_version')->default('');
            // $table->string('cellular')->default('');

            $table->string('last_filename')->nullable();
            $table->integer('upload_res'); // upload resolution
            $table->string('source')->nullable();

            /* server response */

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
        Schema::dropIfExists('logs');
    }
}
