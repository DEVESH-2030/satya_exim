<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdInOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->index()->default(0)->after('order_unique_id');
            $table->unsignedInteger('product_id')->index()->default(0)->after('order_id');
            $table->unsignedInteger('cart_id')->index()->default(0)->after('product_id');
            $table->unsignedInteger('quantity')->index()->default(0)->after('cart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn(['order_id','product_id', 'cart_id', 'quantity']);
        });
    }
}
