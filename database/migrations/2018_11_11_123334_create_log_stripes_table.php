<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogStripesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_stripes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type')->nullable();
            $table->string('user_id')->nullable();
            $table->string('cus_id')->nullable();
            $table->string('sub_id')->nullable();
            $table->json('payload')->nullable();

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
        Schema::dropIfExists('log_stripes');
    }
}
