<?php

namespace App\Services;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityTrackerService
{
    public static function track(
        string $activityType,
        string $activityName,
        ?array $metadata = null,
        ?int $userId = null,
        string $userType = 'user'
    ) {
        $request = request();
        
        // Get user info
        if (!$userId) {
            if ($userType === 'subuser') {
                $userId = Auth::guard('subuser')->id();
            } else {
                $userId = Auth::id();
            }
        }

        UserActivity::create([
            'user_id' => $userId,
            'user_type' => $userType,
            'activity_type' => $activityType,
            'activity_name' => $activityName,
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'metadata' => $metadata,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'session_id' => session()->getId(),
        ]);
    }

    public static function trackPageView(string $pageName, ?array $metadata = null)
    {
        self::track('page_view', $pageName, $metadata);
    }

    public static function trackButtonClick(string $buttonName, ?array $metadata = null)
    {
        self::track('button_click', $buttonName, $metadata);
    }

    public static function trackFormSubmission(string $formName, ?array $formData = null)
    {
        // Remove sensitive data
        if ($formData) {
            $filteredData = collect($formData)->except([
                'password', 'password_confirmation', '_token', 'credit_card', 'cvv'
            ])->toArray();
        }
        
        self::track('form_submission', $formName, $filteredData ?? null);
    }

    public static function trackCreativeGeneration(string $type, ?array $details = null)
    {
        self::track('creative_generation', $type, $details);
    }

    public static function trackDownload(string $itemType, int $itemId, ?array $metadata = null)
    {
        self::track('download', $itemType, array_merge(['item_id' => $itemId], $metadata ?? []));
    }

    public static function trackLogin(string $userType = 'user')
    {
        self::track('authentication', 'login', ['login_type' => $userType], null, $userType);
    }

    public static function trackLogout(string $userType = 'user')
    {
        self::track('authentication', 'logout', ['logout_type' => $userType], null, $userType);
    }

    public static function trackSubscription(string $action, ?array $subscriptionData = null)
    {
        self::track('subscription', $action, $subscriptionData);
    }

    public static function trackPayment(string $action, ?array $paymentData = null)
    {
        self::track('payment', $action, $paymentData);
    }
}