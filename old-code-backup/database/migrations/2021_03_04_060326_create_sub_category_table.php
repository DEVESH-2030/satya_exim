<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('category_id')->index()->nullable();
            $table->string('name')->index()->nullable();
            $table->string('slug')->index()->nullable();
            $table->string('image')->index()->nullable();
            $table->longtext('description')->nullable();
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
        Schema::dropIfExists('sub_categories');
    }
}
