<div id="remove3">
    <nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <img src="{{ asset('img/logo.png') }}" alt="" height="80" width="120">
                    </div>

                    @if (auth()->user()->role == 1)
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('creative.index')" :active="request()->routeIs('creative.index')" class="text-white">
                                {{ __('Creative List') }}
                            </x-nav-link>
                            <x-nav-link :href="route('subusers.index')" :active="request()->routeIs('subusers.index')" class="text-white">
                                {{ __('User Management') }}
                            </x-nav-link>
                            <x-nav-link :href="route('user.download-history')" :active="request()->routeIs('user.download-history')" class="text-white">
                                {{ __('Download History') }}
                            </x-nav-link>
                            <x-nav-link :href="route('billing.overview')" :active="request()->routeIs('billing.overview')" class="text-white">
                                {{ __('Payment History') }}
                            </x-nav-link>
                        </div>
                    @endif

                    @if (auth()->user()->role == 2)
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white">
                                {{ __('Customer List') }}
                            </x-nav-link>
                            <x-nav-link :href="route('superadmin.creative')" :active="request()->routeIs('superadmin.creative')" class="text-white">
                                {{ __('All Creatives') }}
                            </x-nav-link>
                            <x-nav-link :href="route('promocodes.index')" :active="request()->routeIs('promocodes.index')" class="text-white">
                                {{ __('Promo Codes') }}
                            </x-nav-link>
                            <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.index')" class="text-white">
                                {{ __('Plans') }}
                            </x-nav-link>
                            <x-nav-link :href="route('subscriptions.index')" :active="request()->routeIs('subscriptions.index')" class="text-white">
                                {{ __('Subscriptions') }}
                            </x-nav-link>
                            <x-nav-link :href="route('customer.activities')" :active="request()->routeIs('customer.activities')" class="text-white">
                                {{ __('Customer Activities') }}
                            </x-nav-link>
                            <x-nav-link :href="route('payment.logs')" :active="request()->routeIs('payment.logs')" class="text-white">
                                {{ __('Payment Logs') }}
                            </x-nav-link>
                        </div>
                    @endif
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-lg text-white bg-gray-700 hover:bg-gray-600 hover:border-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-200 shadow-lg">
                                <div class="flex items-center">
                                    <!-- User Avatar/Icon -->
                                    <div class="w-7 h-7 bg-blue-600 rounded-full flex items-center justify-center mr-2">
                                        <span class="text-sm font-semibold text-white">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>

                                <div class="ml-2">
                                    <svg class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-xl overflow-hidden">
                                <!-- User Info Header -->
                                <div class="px-4 py-3 bg-gray-750 border-b border-gray-700">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-lg font-semibold text-white">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-2">
                                    <x-dropdown-link :href="route('profile.edit')"
                                        class="flex items-center  px-4 py-3 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('supoprt')"
                                        class="flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-150">
                                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75c0-1.856-.552-3.586-1.5-5.09L12 2.25z">
                                            </path>
                                        </svg>
                                        {{ __('Support') }}
                                    </x-dropdown-link>

                                    <!-- Separator -->
                                    <div class="my-2 border-t border-gray-700"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-colors duration-150">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            @if (auth()->user()->role == 1)
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('creative.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('creative.index') ? 'bg-gray-700' : '' }}">
                        {{ __('Creative List') }}
                    </a>
                    <a href="{{ route('subusers.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('subusers.index') ? 'bg-gray-700' : '' }}">
                        {{ __('User Management') }}
                    </a>
                    <a href="{{ route('user.download-history') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('user.download-history') ? 'bg-gray-700' : '' }}">
                        {{ __('Download History') }}
                    </a>
                    <a href="{{ route('billing.overview') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('billing.overview') ? 'bg-gray-700' : '' }}">
                        {{ __('Payment History') }}
                    </a>
                </div>
            @endif

            @if (auth()->user()->role == 2)
                <!-- Navigation Links -->
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
                        {{ __('Customer List') }}
                    </a>
                    <a href="{{ route('superadmin.creative') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('creative.index') ? 'bg-gray-700' : '' }}">
                        {{ __('All Creatives') }}
                    </a>
                    <a href="{{ route('promocodes.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('promocodes.index') ? 'bg-gray-700' : '' }}">
                        {{ __('Promo Codes') }}
                    </a>
                    <a href="{{ route('plans.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('plans.index') ? 'bg-gray-700' : '' }}">
                        {{ __('Plans') }}
                    </a>
                    <a href="{{ route('subscriptions.index') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('subscriptions.index') ? 'bg-gray-700' : '' }}">
                        {{ __('Subscriptions') }}
                    </a>
                    <a href="{{ route('customer.activities') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out {{ request()->routeIs('customer.activities') ? 'bg-gray-700' : '' }}">
                        {{ __('Customer Activities') }}
                    </a>
                    <x-nav-link :href="route('payment.logs')" :active="request()->routeIs('payment.logs')" class="text-white">
                        {{ __('Payment Logs') }}
                    </x-nav-link>
                </div>
            @endif
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                    <x-responsive-nav-link :href="route('supoprt')">
                        {{ __('Supoprt') }}
                    </x-responsive-nav-link>

                </div>
            </div>
        </div>
    </nav>
</div>
