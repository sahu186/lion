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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('productname')->nullable();
            $table->string('price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
