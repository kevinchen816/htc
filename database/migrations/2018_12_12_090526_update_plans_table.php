<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {

            // $table->unsignedInteger('plan_product_sku_id')->after('status');
            // // $table->foreign('plan_product_sku_id')
            // //       ->references('id')->on('plan_product_skus')
            // //       ->onDelete('cascade'); //NG

            $table->string('sub_plan')->nullable()->after('sms_sent');
            $table->string('sub_id')->nullable()->after('sub_plan');
            $table->timestamp('sub_start')->nullable()->after('sub_id');
            $table->timestamp('sub_end')->nullable()->after('sub_start');
            // $table->string('next_sub_plan')->nullable()->after('sub_end');
            $table->string('renew_plan')->nullable()->after('sub_end');
            $table->string('renew_invoice')->nullable()->after('renew_plan');

            $table->integer('auto_bill')->default(0)->after('renew_invoice');
            $table->integer('auto_reserve')->default(0)->after('auto_bill');
            $table->decimal('reserve', 10, 2)->default(0)->after('auto_reserve'); // points reserve
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('sub_plan');
            $table->dropColumn('sub_id');
            $table->dropColumn('sub_start');
            $table->dropColumn('sub_end');
            $table->dropColumn('renew_plan');
            $table->dropColumn('renew_invoice');
            $table->dropColumn('auto_bill');
            $table->dropColumn('auto_reserve');
            $table->dropColumn('reserve');
        });
    }
}
