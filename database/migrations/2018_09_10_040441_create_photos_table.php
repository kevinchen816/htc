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
            $table->integer('filetype')->nullable();    // 1:JPG, 2:MP4
            $table->integer('uploadtype')->nullable();  // 1:photo_thumb, 2:photo_original, 3:video_thumb, 4:video_original

            $table->string('imagename');
//            $table->string('savename')->nullable(); // 'filepath'
            $table->string('thumb_name')->nullable();
            $table->string('original_name')->nullable();

            $table->integer('filesize')->nullable();

            $table->integer('resolution')->nullable(); //$table->string('upload_resolution');
            // $table->float('points')->default(0);
            $table->decimal('points', 10, 2)->default(0);

            /* photo */
            $table->integer('photo_quality')->nullable();
            $table->integer('photo_compression')->nullable();

            /* video */
            //$table->integer('video_resolution')->nullable();
            $table->integer('video_length')->nullable();
            $table->string('video_sound')->nullable();
            $table->integer('video_rate')->nullable();
            $table->integer('video_bitrate')->nullable();
            //$table->integer('video_filesize')->nullable();

            $table->string('source')->nullable();
            $table->integer('action')->default(0);
            $table->integer('original')->default(0);

            //$table->string('datetime', 14);
            //$table->timestamp('datetime');  // 1970-01-01 00:00:01 ~ 2038-01-19 03:14:07 UTC
            $table->dateTime('datetime');   // 1000-01-01 00:00:00 ~ 9999-12-31 23:59:59
            //$table->date('datetime');

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