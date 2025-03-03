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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('product_price', 10, 3); // Định dạng với 3 chữ số thập phân
            $table->unsignedBigInteger('product_cat_id');
            $table->unsignedBigInteger('product_subcat_id');
            $table->unsignedBigInteger('product_attribute_id');
            $table->string('product_status');
            $table->integer('product_quantity');
            $table->string('product_img');
            $table->timestamps();

            $table->foreign('product_cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('product_subcat_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('product_attribute_id')->references('id')->on('default_attributes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
