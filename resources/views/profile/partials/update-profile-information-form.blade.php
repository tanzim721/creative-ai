<section class="bg-white p-6 rounded-lg shadow-lg">
    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-base text-gray-600">
            {{ __("Update your account's name") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name input -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Name')" class="text-lg font-medium text-gray-900" />
            <x-text-input id="name" name="name" type="text" class="block w-full border border-gray-300 rounded-md p-3 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="text-sm text-red-500 mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email input -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-lg font-medium text-gray-900" />
            <x-text-input id="email" name="email" type="email" class="block w-full border border-gray-300 rounded-md p-3 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500" value="{{ $user->email }}" required readonly autocomplete="username" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4">
                    <p class="text-sm text-gray-600">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="text-indigo-600 hover:text-indigo-800 underline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save button -->
        <div class="flex items-center gap-4">
            <x-primary-button >{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
