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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_type')->default('user'); // user, subuser
            $table->string('activity_type'); // page_view, button_click, form_submission, creative_generation, etc.
            $table->string('activity_name'); // specific action name
            $table->string('url')->nullable(); // current URL
            $table->string('method')->default('GET'); // HTTP method
            $table->json('metadata')->nullable(); // additional data (form data, button info, etc.)
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index('activity_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
