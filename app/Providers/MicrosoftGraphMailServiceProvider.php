<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use App\Channels\MicrosoftGraphChannel;
use App\Services\MicrosoftGraphMailService;

class MicrosoftGraphMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the Microsoft Graph Mail Service
        $this->app->singleton(MicrosoftGraphMailService::class, function ($app) {
            return new MicrosoftGraphMailService();
        });

        // Register the Microsoft Graph Channel
        $this->app->singleton(MicrosoftGraphChannel::class, function ($app) {
            return new MicrosoftGraphChannel($app->make(MicrosoftGraphMailService::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // FIXED: Properly register the notification channel
        $this->app->make(ChannelManager::class)->extend('microsoft-graph', function ($app) {
            return $app->make(MicrosoftGraphChannel::class);
        });
    }
}