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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('orders_id')->nullable();
            $table->unsignedBigInteger('orders_users_id')->nullable();
            $table->string('orders_product');
            $table->unsignedInteger('orders_quantity')->nullable();
            $table->decimal('orders_price', 10, 3);
            $table->string('orders_censor');
            $table->integer('orders_phonenumber')->default(0)->nullable();
            $table->string('orders_address')->default("Trống")->nullable();
            $table->timestamps();

            $table->foreign('orders_users_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('orders_id')->references('id')->on('a_c_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
