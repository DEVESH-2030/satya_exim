<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index()->nullable();
            $table->string('name')->nullable()->index();
            $table->string('mobile')->nullable()->index();
            $table->integer('state_id')->nullable()->index();
            $table->integer('city_id')->nullable()->index();
            $table->integer('pincode')->nullable()->index();
            $table->text('house_no_or_building_name')->nullable();
            $table->text('landmark')->nullable();
            $table->enum('address_type',['House','Office'])->index()->nullable();
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
        Schema::dropIfExists('user_address');
    }
}
