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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['percentage', 'fixed', 'free']);
            $table->decimal('value', 10, 2)->default(0); // Discount amount or percentage
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('usage_limit')->nullable(); // How many times this code can be used
            $table->integer('used_count')->default(0); // How many times this code has been used
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
