<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('mobile_no')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('password')->nullable();
            $table->string('show_password')->nullable()->index();
            $table->integer('country_id')->nullable()->index();
            $table->integer('state_id')->nullable()->index();
            $table->integer('city_id')->nullable()->index();
            $table->integer('pincode')->nullable()->index();
            $table->integer('otp')->nullable()->index();
            $table->text('address')->nullable();
            $table->boolean('email_verify')->default(0)->index();
            $table->boolean('status')->default(0)->index();
            $table->softDeletes();
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
