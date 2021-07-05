<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile')->nullable()->index();
            $table->text('location')->nullable();
            $table->text('address')->nullable();
            $table->text('fax')->nullable();
            $table->text('facebook')->nullable();
            $table->text('gmail')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->string('email')->index()->nullable();
            $table->string('logo')->index()->nullable();
            $table->string('favicon')->index()->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1)->index();
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
        Schema::dropIfExists('settings');
    }
}
