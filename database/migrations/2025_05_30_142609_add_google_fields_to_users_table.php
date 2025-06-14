<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('google_id')->nullable()->unique();
            $table->string('token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->timestamp('token_expires')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn(['google_id', 'token', 'refresh_token', 'token_expires']);
        });
    }

};
