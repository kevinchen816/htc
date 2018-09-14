<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('camera_id')->index();
            //$table->string('module_id');    // iemi
            //$table->string('iccid');
            //$table->string('model_id');

            $table->string('filename');
            $table->integer('upload_resolution'); //$table->string('upload_resolution');
            $table->integer('photo_quality');
            $table->integer('photo_compression');
            $table->string('source');

            //$table->string('datetime', 14);
            //$table->timestamp('datetime');  // 1970-01-01 00:00:01 ~ 2038-01-19 03:14:07 UTC
            $table->dateTime('datetime');   // 1000-01-01 00:00:00 ~ 9999-12-31 23:59:59
            //$table->date('datetime');

            $table->string('filepath');

            $table->index(['created_at']);
            $table->timestamps();   // created_at, updated_at
            //$table->dateTime('created_at');
            //$table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
