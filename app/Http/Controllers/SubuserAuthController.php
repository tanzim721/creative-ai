<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubuserAuthController extends Controller
{
    /**
     * Show the subuser login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('subuser.login');
    }

    /**
     * Handle a subuser login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('subuser')->attempt($credentials)) {
            $request->session()->regenerate();

            // Check if subuser is active
            if (!Auth::guard('subuser')->user()->is_active) {
                Auth::guard('subuser')->logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Please contact your administrator.',
                ]);
            }

            return redirect()->intended(route('subuser.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the subuser out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('subuser')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('subuser.login');
    }
}