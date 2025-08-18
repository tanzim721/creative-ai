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
        Schema::table('creatives', function (Blueprint $table) {
            $table->unsignedBigInteger('game_type_id')->after('creative_type_id');
            $table->foreign('game_type_id')->references('id')->on('game_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('creatives', function (Blueprint $table) {
            $table->dropForeign(['game_type_id']);
            $table->dropColumn('game_type_id');
        });
    }
};
