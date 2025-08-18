<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubuserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if this is a subuser login attempt
        if ($request->is('subuser/login') || $request->is('subuser/authenticate')) {
            return $next($request);
        }

        if (Auth::guard('subuser')->check()) {
            if (!Auth::guard('subuser')->user()->is_active) {
                Auth::guard('subuser')->logout();
                return redirect()->route('subuser.login')
                    ->with('error', 'Your account has been deactivated. Please contact your administrator.');
            }
            return $next($request);
        }

        return redirect()->route('subuser.login');
    }
}