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

            $table->string('user_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('quantity')->nullable();

            $table->string('delivery_address')->nullable();
            $table->string('phone')->nullable();

            $table->string('price')->nullable();

            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();

            $table->timestamps();
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
