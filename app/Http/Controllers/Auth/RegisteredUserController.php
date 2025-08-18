<?php

namespace App\Http\Controllers\Auth;

use Log;
use App\Models\User;
use App\Models\PromoCode;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Services\MicrosoftGraphMailService;

class RegisteredUserController extends Controller
{
    /**
     * List of blocked consumer email domains
     */
    private const BLOCKED_DOMAINS = [
        'gmail.com',
        'yahoo.com',
        'yahoo.co.uk',
        'yahoo.co.in',
        'yahoo.ca',
        'yahoo.com.au',
        'hotmail.com',
        'hotmail.co.uk',
        'hotmail.fr',
        'hotmail.de',
        'outlook.com',
        'live.com',
        'msn.com',
        'aol.com',
        'protonmail.com',
        'icloud.com',
        'me.com',
        'mac.com',
        'yandex.com',
        'mail.ru',
        'rediffmail.com',
        'zoho.com',
        '163.com',
        'qq.com',
        'sina.com',
        'sohu.com',
        'naver.com',
        'daum.net',
        'gmx.com',
        'gmx.de',
        'web.de',
        't-online.de',
        'orange.fr',
        'free.fr',
        'laposte.net',
        'virgilio.it',
        'libero.it',
        'tiscali.it',
        'terra.com.br',
        'uol.com.br',
        'bol.com.br',
        'ig.com.br',
        'globo.com',
        'mail.com',
        'inbox.com',
        'seznam.cz',
        'wp.pl',
        'o2.pl',
        'interia.pl',
        'abv.bg',
        'mail.bg',
        'rambler.ru',
        'list.ru',
        'bk.ru',
        'inbox.ru'
    ];

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info('Register request:', $request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string', 'max:5'],
            'mobile' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                'unique:'.User::class,
                function ($attribute, $value, $fail) {
                    $domain = strtolower(substr(strrchr($value, "@"), 1));
                    if (in_array($domain, self::BLOCKED_DOMAINS)) {
                        $fail('Please use your work email address. Personal email addresses (Gmail, Yahoo, Hotmail, etc.) are not allowed.');
                    }
                }
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'admin_code' => ['nullable', 'string'],
        ], [
            'email.required' => 'Work email is required.',
            'email.email' => 'Please enter a valid work email address.',
            'email.unique' => 'This email address is already registered.',
            'country_code.required' => 'Please select a country code.',
        ]);

        $role = 0;
        if ($request->has('admin_code')) {
            // Check if the admin_code exists and is active in the promo_code table
            $validPromoCode = PromoCode::where('code', $request->admin_code)
                                    ->where('is_active', true)
                                    ->first();
                            
            if ($validPromoCode) {
                $role = 1;
            }
        }
        
        // Combine country code and mobile number
        $fullMobile = $request->country_code . $request->mobile;
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $fullMobile,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        $user->sendEmailVerificationNotification();

        // Custom verification email using Microsoft Graph
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $body = "Click here to verify your email: <a href='{$verifyUrl}'>Verify Email</a>. After verification, you can log in to your account.";

        try {
            app(MicrosoftGraphMailService::class)->sendMail($user->email, 'Toucan Verify Your Email', $body);
        } catch (\Throwable $e) {
            \Log::error("Registration Failed: " . $e->getMessage());
            \Log::error($e->getTraceAsString());
            abort(500, 'Registration error.');
        }
        return redirect()->route('verification.notice');
    }

    /**
     * Get the list of blocked domains (useful for frontend validation)
     */
    public static function getBlockedDomains(): array
    {
        return self::BLOCKED_DOMAINS;
    }
}