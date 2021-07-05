<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us_mail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->index();
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('mobile')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->text('message')->nullable();
            $table->boolean('status')->default(0)->comment('1 is Active and 0 is Inactive')->index();
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
        Schema::dropIfExists('contact_us_mail');
    }
}
