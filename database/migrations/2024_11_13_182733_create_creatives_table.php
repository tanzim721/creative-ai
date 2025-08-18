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
        if (!Schema::hasTable('creatives')) {
            Schema::create('creatives', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('creative_type_id');
                $table->json('image')->nullable();
                $table->json('video')->nullable();
                $table->string('content')->nullable();
                $table->string('cta_name')->nullable();
                $table->string('landing_url')->nullable();
                $table->string('tracking_url')->nullable();
                $table->string('creative_name')->nullable();
                $table->timestamps();
    
                // Foreign keys (if applicable)
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('creative_type_id')->references('id')->on('creative_types')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatives');
    }
};
