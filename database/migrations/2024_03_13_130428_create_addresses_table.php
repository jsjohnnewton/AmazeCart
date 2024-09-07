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
        Schema::create('addresses', function (Blueprint $table) {

            $table->id();

            $table->string('user_id')->nullable();
            $table->string('active')->nullable();
            $table->string('door_number')->nullable(); // Door number
            $table->string('street')->nullable(); // Street address
            $table->string('post_office')->nullable(); 
            $table->string('district')->nullable(); // City
            $table->string('state')->nullable(); // State/Province
            $table->string('pincode')->nullable(); // Postal/ZIP Code

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
