<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_products', function (Blueprint $table) {
            $table->increments('id');

            /* USA (AT&T), Canada, Europe, Australia */
            $table->string('region');       // us, ca, eu, au, cn, tw
            $table->string('currency');     // usd, cad, eur, aud, cny, twd
            $table->string('title');        // BRONZE, SILVER, GOLD, PLATINUM PRO
            $table->string('description');  // 5000 Points per Month // $table->text
            $table->integer('points')->default(0);
            $table->bigInteger('data_plans')->default(0);
            $table->string('image');
            // $table->boolean('on_sale')->default(true);
            $table->integer('active')->default(0);
            $table->float('rating')->default(5);
            $table->unsignedInteger('sold_count')->default(0);
            // $table->unsignedInteger('review_count')->default(0);
            $table->decimal('price', 10, 2)->default(0);

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
        Schema::dropIfExists('plan_products');
    }
}