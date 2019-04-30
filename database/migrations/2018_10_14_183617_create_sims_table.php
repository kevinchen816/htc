<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sims', function (Blueprint $table) {
            $table->increments('id');

            $table->string('iccid')->unique();
        $table->string('sim_sn')->nullable();
            $table->string('imsi')->nullable();
        $table->string('msisdn')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('region')->nullable();   // us, ca, eu, au, cn, tw
        $table->string('operator')->nullable();
            $table->string('style')->nullable();    // Prepaid, Pay as you go, Development (test)
            $table->string('status')->nullable();   // active, preactive, suspend
            $table->string('note')->nullable();

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
        Schema::dropIfExists('sims');
    }
}