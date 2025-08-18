<x-guest-layout>
    <!-- Center the form -->
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-700">Create Your Account</h2>
        <p class="mt-1 text-sm text-center text-gray-600">Please fill out the form to register</p>

        <form method="POST" action="{{ route('register') }}" class="mt-6" id="registrationForm">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Work Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <div id="email-warning" class="hidden mt-2 text-sm text-red-600">
                    Please use your work email address. Personal email addresses (Gmail, Yahoo, Hotmail, etc.) are not allowed.
                </div>
                <div class="mt-1 text-xs text-gray-500">
                    Only business/work email addresses are accepted
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="mt-4">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="text" name="company_name" :value="old('company_name')" required autocomplete="organization" />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <!-- Company Address -->
            <div class="mt-4">
                <x-input-label for="company_address" :value="__('Country')" />
                <select id="company_address" name="company_address" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="" disabled selected>Choose Country</option>
                    @foreach (\App\Enums\CountryEnum::cases() as $country)
                        <option value="{{ $country->value }}" {{ old('company_address') == $country->value ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
            </div>
            
            <!-- Mobile Number with Country Code -->
            <div class="mt-4">
                <x-input-label for="mobile" :value="__('Mobile Number')" />
                <div class="flex">
                    <select id="country_code" name="country_code" class="w-24 border-gray-300 rounded-l-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50" required>
                        <option value="">Code</option>
                        @foreach (\App\Enums\CountryCodeEnum::cases() as $code)
                            <option value="{{ $code->value }}" {{ old('country_code') == $code->value ? 'selected' : '' }}>{{ $code->value }}</option>
                        @endforeach
                    </select>
                    <x-text-input id="mobile"
                        class="block flex-1 border-gray-300 rounded-r-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-l-0"
                        type="number" name="mobile" :value="old('mobile')" required autocomplete="tel" placeholder="1234567890" />
                </div>
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="admin_code" :value="__('Promo Code (Optional)')" />
                <x-text-input id="admin_code" class="block mt-1 w-full" type="text" name="admin_code" :value="old('admin_code')" />
                <x-input-error :messages="$errors->get('admin_code')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Already registered?') }}
                </a>
                <x-primary-button id="submit-btn"
                    class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 flex justify-center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        // Blocked email domains
        const blockedDomains = [
            'gmail.com', 'yahoo.com', 'yahoo.co.uk', 'yahoo.co.in', 'yahoo.ca', 'yahoo.com.au',
            'hotmail.com', 'hotmail.co.uk', 'hotmail.fr', 'hotmail.de', 'outlook.com', 'live.com',
            'msn.com', 'aol.com', 'protonmail.com', 'icloud.com', 'me.com', 'mac.com',
            'yandex.com', 'mail.ru', 'rediffmail.com', 'zoho.com', '163.com', 'qq.com',
            'sina.com', 'sohu.com', 'naver.com', 'daum.net', 'gmx.com', 'gmx.de',
            'web.de', 't-online.de', 'orange.fr', 'free.fr', 'laposte.net', 'virgilio.it',
            'libero.it', 'tiscali.it', 'terra.com.br', 'uol.com.br', 'bol.com.br',
            'ig.com.br', 'globo.com', 'mail.com', 'inbox.com', 'seznam.cz', 'wp.pl',
            'o2.pl', 'interia.pl', 'abv.bg', 'mail.bg', 'rambler.ru', 'list.ru', 'bk.ru', 'inbox.ru'
        ];

        // Country to country code mapping using enum values
        const countryCodeMapping = @json(\App\Enums\CountryCodeEnum::getAllCountryCodes());
        
        // Convert country names to match enum case format
        function normalizeCountryName(name) {
            return name.toUpperCase().replace(/[\s-]/g, '_');
        }

        // Email validation function
        function validateEmail(email) {
            if (!email || !email.includes('@')) return true; // Let HTML5 handle basic validation
            
            const domain = email.split('@')[1]?.toLowerCase();
            return !blockedDomains.includes(domain);
        }

        // Real-time email validation
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const warning = document.getElementById('email-warning');
            const submitBtn = document.getElementById('submit-btn');
            
            if (email && !validateEmail(email)) {
                warning.classList.remove('hidden');
                this.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                this.classList.remove('border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                warning.classList.add('hidden');
                this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                this.classList.add('border-gray-300', 'focus:border-indigo-500', 'focus:ring-indigo-500');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });

        // Form submission validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            
            if (email && !validateEmail(email)) {
                e.preventDefault();
                alert('Please use your work email address. Personal email addresses (Gmail, Yahoo, Hotmail, etc.) are not allowed.');
                return false;
            }
        });

        // Auto-select country code when country is selected
        document.getElementById('company_address').addEventListener('change', function() {
            const selectedCountry = this.value;
            const countryCodeSelect = document.getElementById('country_code');
            
            if (selectedCountry) {
                // Normalize the country name to match enum format
                const normalizedCountry = normalizeCountryName(selectedCountry);
                
                // Find matching country code
                const countryCode = countryCodeMapping[normalizedCountry];
                
                if (countryCode) {
                    // Set the country code
                    countryCodeSelect.value = countryCode;
                } else {
                    // If no exact match found, clear the selection
                    countryCodeSelect.value = '';
                }
            } else {
                // Clear country code if no country selected
                countryCodeSelect.value = '';
            }
        });

        // Optional: Allow manual country code selection to override auto-selection
        document.getElementById('country_code').addEventListener('change', function() {
            // User manually selected a country code, so don't auto-update it
            this.dataset.manualSelection = 'true';
        });

        // Update the auto-selection logic to respect manual selection
        document.getElementById('company_address').addEventListener('change', function() {
            const selectedCountry = this.value;
            const countryCodeSelect = document.getElementById('country_code');
            
            // Only auto-select if user hasn't manually selected a code
            if (selectedCountry && !countryCodeSelect.dataset.manualSelection) {
                const normalizedCountry = normalizeCountryName(selectedCountry);
                const countryCode = countryCodeMapping[normalizedCountry];
                
                if (countryCode) {
                    countryCodeSelect.value = countryCode;
                } else {
                    countryCodeSelect.value = '';
                }
            } else if (!selectedCountry) {
                // Always clear when no country is selected
                countryCodeSelect.value = '';
                delete countryCodeSelect.dataset.manualSelection;
            }
        });
    </script>
</x-guest-layout>