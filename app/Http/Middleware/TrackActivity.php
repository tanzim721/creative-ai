<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ActivityTrackerService;
use Illuminate\Support\Facades\Auth;

class TrackActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only track for authenticated users
        if (Auth::check() || Auth::guard('subuser')->check()) {
            $this->trackPageView($request);
        }

        return $response;
    }

    private function trackPageView(Request $request)
    {
        // Skip tracking for certain routes
        $skipRoutes = [
            'creative.get-credits',
            '_debugbar',
            'telescope',
            'horizon'
        ];

        $routeName = $request->route()?->getName();
        
        if ($routeName && !in_array($routeName, $skipRoutes)) {
            $pageName = $this->getReadablePageName($routeName, $request);
            
            $metadata = [
                'route_name' => $routeName,
                'parameters' => $request->route()?->parameters() ?? [],
            ];

            // Determine user type
            $userType = Auth::guard('subuser')->check() ? 'subuser' : 'user';
            
            ActivityTrackerService::track('page_view', $pageName, $metadata, null, $userType);
        }
    }

    private function getReadablePageName(string $routeName, Request $request): string
    {
        $pageNames = [
            'home' => 'Home Page',
            'dashboard' => 'Creative Dashboard',
            'creative.index' => 'Creative List',
            'carousel.show' => 'Creative Details',
            'admin.dashboard' => 'Super Admin Dashboard',
            'admin.users' => 'User Management',
            'billing.overview' => 'Billing Overview',
            'subusers.index' => 'Subuser Management',
            'profile.edit' => 'Profile Settings',
            'customer.activities' => 'Customer Activities',
            'payment.logs' => 'Payment Logs',
            'subuser.dashboard' => 'Subuser Dashboard',
        ];

        return $pageNames[$routeName] ?? ucwords(str_replace(['.', '-'], ' ', $routeName));
    }
}