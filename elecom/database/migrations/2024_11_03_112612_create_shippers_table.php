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
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ship_orders_id')->nullable();
            $table->string('ship_users')->nullable();
            $table->string('ship_product');
            $table->unsignedInteger('ship_quantity')->nullable();
            $table->decimal('ship_price', 10, 3);
            $table->integer('ship_phonenumber')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('ship_thank')->nullable();
            $table->timestamps();

            $table->foreign('ship_orders_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippers');
    }
};
