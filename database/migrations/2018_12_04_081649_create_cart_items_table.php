<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');

            /* 注意: 当创建一个参照递增整数类型的外键的时候，记得把外键字段的类型定义为无符号。*/
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('plan_product_sku_id');
            $table->foreign('plan_product_sku_id')->references('id')->on('plan_product_skus')->onDelete('cascade');

            $table->unsignedInteger('quantity');

            $table->string('iccid')->default('');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
