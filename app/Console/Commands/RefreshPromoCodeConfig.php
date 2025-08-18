<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class RefreshPromoCodeConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promo:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the promo code configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Previous admin code: ' . config('auth.defaults.admin_code'));
        
        // Get active code from database
        $activeCode = PromoCode::valid()->first()?->code;
        
        if ($activeCode) {
            // Update the config
            Config::set('auth.defaults.admin_code', $activeCode);
            
            // Clear config cache if it exists
            if (file_exists(app()->getCachedConfigPath())) {
                $this->call('config:cache');
            }
            
            $this->info('Config updated with active code: ' . $activeCode);
        } else {
            $this->warn('No active promo code found in database');
        }
        
        $this->info('Current admin code: ' . config('auth.defaults.admin_code'));
    }
}