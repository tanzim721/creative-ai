<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckPromoCodeConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promo:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the current active promo code in the config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Current active admin code: ' . config('auth.defaults.admin_code'));
    }
}