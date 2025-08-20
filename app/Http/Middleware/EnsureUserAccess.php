<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('web')->user();
        $subuser = Auth::guard('subuser')->user();

        if (!$user && !$subuser) {
            return redirect('/login');
        }

        // If subuser, check if active
        if ($subuser && !$subuser->is_active) {
            Auth::guard('subuser')->logout();
            return redirect('/login')->withErrors(['email' => 'Account deactivated.']);
        }

        return $next($request);
    }
}