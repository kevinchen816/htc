<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_history', function (Blueprint $table) {
            $table->increments('id');

            $table->string('iccid')->index();
            $table->integer('user_id');

            $table->string('event')->nullable();
            $table->string('status')->nullable();
            $table->integer('points')->nullable()->default(0);
            $table->decimal('points_reserve', 10, 2)->nullable()->default(0);
            $table->integer('plans')->nullable()->default(0);
            $table->integer('plans_reserve')->nullable()->default(0);

            $table->string('sub_id')->nullable();   // sub_EAh5xs7HT6ObHB
            $table->string('sub_plan')->nullable(); // au_5000_1m
            $table->timestamp('sub_start')->nullable();
            $table->timestamp('sub_end')->nullable();

            $table->string('pay_invoice')->nullable(); // in_1DhiAVG8UgnSL68UZhx96Hwk
            $table->string('pay_method')->nullable();
            $table->string('pay_no')->nullable();
            $table->json('pay_info')->nullable();
            $table->dateTime('pay_at')->nullable();

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
        Schema::dropIfExists('plan_history');
    }
}