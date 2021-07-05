<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable()->index();
            $table->string('password_plain_text')->nullable();
            $table->bigInteger('forgot_password')->nullable();
            $table->integer('otp')->nullable();
            $table->boolean('status')->default(false)->index();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('admin_logins');
    }
}
