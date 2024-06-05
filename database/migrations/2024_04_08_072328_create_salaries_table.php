<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('date')->nullable();
            $table->integer('basic_salary')->nullable();
            $table->integer('on_time')->nullable();
            $table->integer('no_day_off')->nullable();
            $table->integer('company_bonus')->nullable();
            $table->integer('movie_bonus')->nullable();
            $table->integer('daily_movie_bonus')->nullable();
            $table->integer('pocket_money')->nullable();
            $table->integer('yearly_bonus')->nullable();
            $table->integer('extra_money')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
