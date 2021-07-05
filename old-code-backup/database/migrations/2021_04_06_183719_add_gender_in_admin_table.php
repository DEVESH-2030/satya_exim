<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderInAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_logins', function (Blueprint $table) {
            $table->enum('gender',['Male', 'Female', 'Other'])->nullable()->index()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_logins', function (Blueprint $table) {
            $table->dropColumn(['gender']);
        });
    }
}
