<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmwares', function (Blueprint $table) {
            $table->increments('id');

            //$table->integer('model_id')->nullable();
            $table->string('model')->nullable(); // 	lookout-na
            //$table->string('description')->nullable(); // Lookout North America
            $table->string('version')->nullable();
            $table->integer('active')->default(0);
            //$table->string('path')->nullable();
            $table->string('carrier')->nullable(); // truphone ??
            $table->string('type')->nullable(); // 0:BIN, 1:ZIP (File Extension)

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
        Schema::dropIfExists('firmwares');
    }
}
