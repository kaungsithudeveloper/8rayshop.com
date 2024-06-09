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
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('product_categories_id');
            $table->unsignedBigInteger('product_sub_categories_id');
            $table->unsignedBigInteger('product_type_id');
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->text('short_descp');
            $table->text('long_descp');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('product_categories_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('product_sub_categories_id')->references('id')->on('product_sub_categories')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
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
