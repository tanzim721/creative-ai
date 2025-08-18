<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SubuserLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubuserAuthenticatedSessionController extends Controller
{
    /**
     * Display the subuser login view.
     */
    public function create(): View
    {
        return view('auth.subuser-login');
    }

    /**
     * Handle an incoming subuser authentication request.
     */
    public function store(SubuserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated subuser session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('subuser')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/subuser/login');
    }
}