<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_product_skus', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('description')->nullable();;
            $table->integer('active')->default(0); // $table->boolean('on_sale')->default(true);
            $table->float('rating')->default(5);
            $table->unsignedInteger('sold_count')->default(0);
            $table->integer('month')->default(1);
            $table->decimal('price', 10, 2);
            // $table->unsignedInteger('stock');

            /* 注意: 当创建一个参照递增整数类型的外键的时候，记得把外键字段的类型定义为无符号。*/
            $table->unsignedInteger('plan_product_id');
            $table->foreign('plan_product_id')
                  ->references('id')->on('plan_products')
                  ->onDelete('cascade');

            $table->string('sub_id');

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
        Schema::dropIfExists('plan_product_skus');
    }
}
