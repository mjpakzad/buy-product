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
        Schema::create('order_product', function (Blueprint $table) {
            $table->foreignId('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('amount')->default(0);
            $table->unsignedBigInteger('total_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
