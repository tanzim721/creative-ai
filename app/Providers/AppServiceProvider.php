<?php

namespace App\Providers;

use URL;
use App\Channels\MicrosoftGraphChannel;
use Illuminate\Support\ServiceProvider;
use App\Services\MicrosoftGraphMailService;
use Illuminate\Notifications\ChannelManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if (env(key: 'APP_ENV') !=='local') {
        //     URL::forceScheme(scheme:'https');
        //   }
        // Register the PromoCodeService
        $this->app->register(PromoCodeServiceProvider::class);
        
        // Register Microsoft Graph Mail Service
        // $this->app->singleton(MicrosoftGraphMailService::class, function ($app) {
        //     return new MicrosoftGraphMailService();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom notification channel
        $this->app->make(ChannelManager::class)->extend('microsoft-graph', function ($app) {
            return new MicrosoftGraphChannel($app->make(MicrosoftGraphMailService::class));
        });
    }
}
