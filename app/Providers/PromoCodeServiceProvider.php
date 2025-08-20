<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Config;

class PromoCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            // Skip this during migrations or when database is not available
            if ($this->app->runningInConsole() && !$this->app->runningUnitTests()) {
                // Check if we're running migrations
                $command = $_SERVER['argv'][1] ?? null;
                if ($command === 'migrate') {
                    return;
                }
            }
            
            // Get the active promo code from the database
            // $activeCode = PromoCode::valid()->first()?->code;
            
            // if ($activeCode) {
            //     // Set the active code in the auth config
            //     config(['auth.defaults.admin_code' => $activeCode]);
            // }
        } catch (\Exception $e) {
            // If there's any issue (like during migrations), just continue with the default
            report($e);
        }
    }
}