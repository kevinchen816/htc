<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('confirmed')->default('No'); // Yes, No

            // "laravel/cashier"
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('subscription_ends_at')->nullable(); // ?

            $table->string('date_format')->default('Y/m/d H:i:s');
            $table->integer('portal')->default(0);
            $table->integer('permission')->default(0);
            $table->string('sel_menu')->default('plan');            // plan, camera, account, help, support, user
            $table->integer('sel_camera')->nullable();              // camera_id
            $table->string('sel_camera_tab')->default('overview');  // overview, gallery, settings, actions, options
            //$table->string('sel_account_tab')->default('planspermission');     // plans, billing, remote, security, email
            $table->string('sel_account_tab')->default('plans');     // plans, billing, remote, security, email
                                                                   // plan, billing, devices, options, email
            //$table->integer('notification_count')->unsigned()->default(0);

            $table->rememberToken();
            $table->timestamps();
        });

        // "laravel/cashier": "~7.0"
        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('subscriptions');
    }
}
