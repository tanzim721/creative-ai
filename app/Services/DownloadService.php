<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;
use App\Models\Download;

class DownloadService
{
    public function recordDownload(User $user, $contentType, $contentId)
    {
        $subscription = $user->activeSubscription();
        
        if (!$subscription) {
            // User is on free plan
            $freePlan = Plan::where('slug', 'free')->first();
            
            if (!$freePlan) {
                throw new \Exception('No free plan configured and user has no active subscription');
            }
            
            // Count current month's downloads
            $monthlyDownloads = $user->downloads()
                ->whereDate('created_at', '>=', now()->startOfMonth())
                ->count();
                
            if ($freePlan->monthly_download_limit > 0 && $monthlyDownloads >= $freePlan->monthly_download_limit) {
                throw new \Exception('Free download limit exceeded');
            }
            
            // Create download record without subscription
            return Download::create([
                'user_id' => $user->id,
                'subscription_id' => null,
                'content_type' => $contentType,
                'content_id' => $contentId,
            ]);
        }
        
        // Check if user has downloads left in their subscription
        if (!$subscription->hasDownloadsLeft()) {
            throw new \Exception('Download limit exceeded for your subscription');
        }
        
        // Record the download
        $download = Download::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'content_type' => $contentType,
            'content_id' => $contentId,
        ]);
        
        // Increment the downloads used counter
        $subscription->increment('downloads_used');
        
        return $download;
    }
    
    public function getUserDownloadsThisMonth(User $user)
    {
        return $user->downloads()
            ->whereDate('created_at', '>=', now()->startOfMonth())
            ->whereDate('created_at', '<=', now()->endOfMonth())
            ->count();
    }
}