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
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->string('card_last_4', 4)->nullable()->after('payment_method');
            $table->string('card_brand')->nullable()->after('card_last_4');
            $table->string('stripe_subscription_id')->nullable()->after('card_brand');
            $table->string('transaction_type')->default('one_time')->after('stripe_subscription_id'); // one_time, subscription, renewal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->dropColumn(['card_last_4', 'card_brand', 'stripe_subscription_id', 'transaction_type']);
        });
    }
};
