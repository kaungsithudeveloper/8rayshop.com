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
        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('product_size')->nullable();
            $table->text('short_descp');
            $table->text('long_descp');
            $table->string('url')->nullable();;
            $table->integer('new')->nullable();
            $table->integer('hot')->nullable();
            $table->integer('sale')->nullable();
            $table->integer('best_sale')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_infos');
    }
};
