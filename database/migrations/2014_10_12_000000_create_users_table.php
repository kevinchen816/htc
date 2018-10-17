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

            $table->string('sel_menu')->default('plan');            // plan, camera, account, help, support, user
            $table->integer('sel_camera')->nullable();              // camera_id
            $table->string('sel_camera_tab')->default('overview');  // overview, gallery, settings, actions, options
            $table->string('sel_account_tab')->default('plans');     // plans, billing, remote, security, email
                                                                   // plan, billing, devices, options, email

            $table->rememberToken();
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
    }
}
