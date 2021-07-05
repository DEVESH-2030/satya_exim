<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_unique_id')->nullable()->index();            
            $table->string('transection_id')->nullable()->index();            
            $table->integer('order_status')->default(0)->index();            
            $table->integer('order_amount')->default(0)->index();            
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
        Schema::dropIfExists('order_details');
    }
}
