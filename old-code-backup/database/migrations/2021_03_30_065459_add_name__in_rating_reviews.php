<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameInRatingReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rating_reviews', function (Blueprint $table) {
            $table->string('name')->nullable()->index()->after('id');
            $table->string('email')->nullable()->index()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rating_reviews', function (Blueprint $table) {
            //
        });
    }
}
