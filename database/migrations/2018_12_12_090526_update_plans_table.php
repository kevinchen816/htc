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

            $table->unsignedInteger('plan_product_sku_id')->after('status');
            // $table->foreign('plan_product_sku_id')
            //       ->references('id')->on('plan_product_skus')
            //       ->onDelete('cascade'); //NG
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
            $table->dropColumn('plan_product_sku_id');
        });
    }
}
