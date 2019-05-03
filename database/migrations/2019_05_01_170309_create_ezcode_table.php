<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEzcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ezcode', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ezcode')->unique();
            $table->string('module_id')->nullable()->index();

            // $table->string('region')->nullable()->default('tw'); // tw, cn, us, ca, eu, au
            $table->string('style')->nullable()->default('normal'); // normat, test
            $table->string('status')->nullable()->default('deactive');   // active, deactive, suspend

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
        Schema::dropIfExists('ezcode');
    }
}