<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0)->index();            
            $table->string('order_id')->nullable()->index();            
            $table->bigInteger('cart_id')->default(0)->index();            
            $table->bigInteger('address_id')->default(0)->index();          
            $table->integer('order_status')->default(0)->index();            
            $table->boolean('payment_status')->default(false)->index();            
            $table->boolean('status')->default(true)->index();            
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
