<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->nullable();
            $table->string('slug')->index()->nullable();
            $table->string('image')->index()->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default('1')->comment('1 is for Active and 0 is for inactive')->index();
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
        Schema::dropIfExists('content_managements');
    }
}
