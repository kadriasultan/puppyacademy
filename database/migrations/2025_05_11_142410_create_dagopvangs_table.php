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
        Schema::create('dagopvangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('dog_id')->nullable();
            $table->string('naam');
            $table->string('adres');
            $table->string('woonplaats');
            $table->string('soort_hond');
            $table->string('naam_hond');
            $table->string('roepnaam');
            $table->string('telefoon');
            $table->string('email');
            $table->date('voorkeursdatum')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('dog_id')->references('id')->on('dogs')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dagopvangs');
    }
};
