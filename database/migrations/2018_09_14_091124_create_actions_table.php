<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('camera_id')->index();
            $table->string('action');
            $table->integer('status')->default(0); // 1:request, 2:cancel, 3:pending, 4:completed
            $table->dateTime('requested');
            $table->dateTime('completed')->nullable();

            $table->string('filename')->nullable();
            $table->integer('image_size')->nullable();
            $table->integer('compression')->nullable();
            $table->integer('photo_id')->default(0);    // UO
            $table->integer('photo_cnt')->default(0);   // photo count for schedule uploaded
            $table->integer('first_number')->default(0);
            $table->integer('last_number')->default(0);
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
        Schema::dropIfExists('actions');
    }
}
