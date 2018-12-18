<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iccid')->unique();
            $table->integer('user_id')->index();
            $table->integer('camera_id')->nullable();

            $table->string('region')->default('au');               // us, ca, eu, au, cn, tw
            $table->string('style')->nullable()->default('normal');    // Prepaid, Pay as you go
            $table->string('status')->nullable();   // active, preactive, suspend

            // $table->integer('bill_points')->default(0); // 5000, 10000, 20000
            // $table->integer('bill_month')->default(1); // 1, 3
            // $table->float('bill_price')->default(0);
            // $table->date('bill_begin')->nullable();
            // $table->date('bill_end')->nullable();

            // $table->integer('auto_bill')->default(0);
            // $table->integer('auto_reserve')->default(0);

            // $table->date('date_renew')->nullable();
            // $table->date('date_bill')->nullable();

            // $table->float('points')->default(0);
            // $table->float('points_used')->default(0);
            $table->decimal('points', 10, 2)->default(0);
            $table->decimal('points_used', 10, 2)->default(0);

            // $table->integer('sms')->default(0);
            $table->integer('sms_sent')->default(0);

            $table->timestamps();
        });
    }

/*
for status = active

    if (date_renew == now) {
        date_renew += 1 month;

        if (date_bill == now) {

            if (auto_bill) {
                if (credit card charge OK) {
                    points_used = 0;
                    date_bill += bill_month;
                    status = [Acive];
                } else {
                    status = [Suspend];
                }
            } else {
                status = [Suspend];
            }

        } else if (date_bill > now) {

            //if (auto_bill) {
                points_used = 0;
                status = [Acive];
            //}

        } else {

            ** NG **
        }
    }
*/



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
