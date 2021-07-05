<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->nullable();
            $table->string('sub_title')->index()->nullable();
            $table->string('slug')->index()->nullable();
            $table->string('product_type')->index()->nullable();
            $table->bigInteger('category_id')->index()->default(0);
            $table->bigInteger('sub_category_id')->index()->default(0);
            $table->bigInteger('brand_id')->index()->default(0);
            $table->bigInteger('variant_id')->index()->default(0);
            $table->bigInteger('color_id')->index()->default(0);
            $table->double('original_price', 8, 2)->index()->nullable();
            $table->double('discount_product_percentage', 8, 2)->index()->nullable();
            $table->double('selling_price', 8, 2)->index()->nullable();
            $table->double('total_stock', 8, 2)->index()->nullable();
            $table->double('remaning_stock', 8, 2)->index()->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->longText('key_feature')->nullable();            
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
        Schema::dropIfExists('products');
    }
}
