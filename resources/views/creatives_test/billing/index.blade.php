@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative - Billing & Subscriptions')
@section('meta-description', 'Manage your Toucan Creative subscription, billing, and payment history')

@section('content')
    <x-app-layout>
        <div class="min-h-screen bg-black py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex items-center space-x-3 mb-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <h5 class="text-sm font-bold text-white">Billing & Subscriptions</h5>
                    </div>
                </div>

                <!-- Main Content Container -->
                <div class="bg-white/70 backdrop-blur-sm shadow-2xl rounded-2xl border border-white/20 overflow-hidden">

                    <!-- Enhanced Tab Navigation -->
                    <div class="border-b border-gray-100 bg-white/50">
                        <nav class="flex px-6" aria-label="Tabs">
                            <button onclick="showTab('overview')" id="overview-tab"
                                class="tab-btn group relative px-6 py-4  text-sm transition-all duration-200 border-b-2 border-indigo-500 text-indigo-600">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    <span>Overview</span>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-indigo-500 rounded-full"></div>
                            </button>

                            <button onclick="showTab('subscriptions')" id="subscriptions-tab"
                                class="tab-btn group relative px-6 py-4  text-sm transition-all duration-200 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                    <span>Subscription</span>
                                </div>
                            </button>

                            <button onclick="showTab('billing-history')" id="billing-history-tab"
                                class="tab-btn group relative px-6 py-4  text-sm transition-all duration-200 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <span>Payment History</span>
                                </div>
                            </button>
                        </nav>
                    </div>

                    <!-- Overview Tab Content -->
                    <div id="overview-content" class="tab-content p-8">
                        @if (isset($subscription) && $subscription)
                            <div
                                class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl p-8 border border-gray-100">
                                <div class="flex items-center justify-between mb-6">
                                    <h5 class="text-sm font-bold text-gray-900">Current Subscription</h5>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-sm font-medium text-green-600">Active</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <!-- Plan Details -->
                                    <div class="space-y-6">
                                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                                            <h3 class="text-sm text-gray-900 mb-4 flex items-center">
                                                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                                Plan Information
                                            </h3>

                                            <div class="space-y-3">
                                                <div
                                                    class="flex justify-between items-center py-2 border-b border-gray-100">
                                                    <span class="text-gray-900">Plan Name</span>
                                                    <span class="text-sm text-gray-900">
                                                        {{ isset($subscription->plan) && $subscription->plan ? $subscription->plan->name : 'N/A' }}
                                                    </span>
                                                </div>

                                                <div
                                                    class="flex justify-between items-center py-2 border-b border-gray-100">
                                                    <span class="text-gray-900">Billing Cycle</span>
                                                    <span class="text-sm text-gray-900 capitalize">
                                                        {{ $subscription->billing_cycle ?? 'N/A' }}
                                                    </span>
                                                </div>

                                                <div class="flex justify-between items-center py-2">
                                                    <span class="text-gray-900">Status</span>
                                                    <span
                                                        class="px-3 py-1 rounded-full text-xs
                                                        @if (isset($subscription->status) && $subscription->status === 'active') bg-green-100 text-green-700 border border-green-200
                                                        @elseif(isset($subscription->status) && $subscription->status === 'canceled') bg-red-100 text-red-700 border border-red-200
                                                        @elseif(isset($subscription->status) && $subscription->status === 'past_due') bg-yellow-100 text-yellow-700 border border-yellow-200
                                                        @else bg-gray-100 text-gray-700 border border-gray-200 @endif">
                                                        {{ isset($subscription->status) ? ucfirst($subscription->status) : 'Unknown' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Billing Details -->
                                    <div class="space-y-6">
                                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                                            <h3 class="text-sm text-gray-900 mb-4 flex items-center">
                                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                                    </path>
                                                </svg>
                                                Billing Details
                                            </h3>

                                            <div class="space-y-3">
                                                <div
                                                    class="flex justify-between items-center py-2 border-b border-gray-100">
                                                    <span class="text-gray-900">Start Date</span>
                                                    <span class="text-sm text-gray-900">
                                                        {{ isset($subscription->starts_at) && $subscription->starts_at ? $subscription->starts_at->format('M j, Y') : 'N/A' }}
                                                    </span>
                                                </div>

                                                <div
                                                    class="flex justify-between items-center py-2 border-b border-gray-100">
                                                    <span class="text-gray-900">Next Billing</span>
                                                    <span class="text-sm text-gray-900">
                                                        {{ isset($subscription->expires_at) && $subscription->expires_at ? $subscription->expires_at->format('M j, Y') : 'N/A' }}
                                                    </span>
                                                </div>

                                                <div class="flex justify-between items-center py-2">
                                                    <span class="text-gray-900">Amount</span>
                                                    <span class="text-sm font-bold text-indigo-600">
                                                        ${{ isset($subscription->amount_paid) ? number_format($subscription->amount_paid, 2) : '0.00' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-8 flex flex-wrap gap-4">
                                    @if (isset($subscription->status) && $subscription->status === 'active')
                                        <form method="POST" action="{{ route('billing.subscription.cancel') }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm px-6 py-3 bg-red-500 hover:bg-red-600 text-white  rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                                                onclick="return confirm('Are you sure you want to cancel your subscription?')">
                                                Cancel Subscription
                                            </button>
                                        </form>
                                    @elseif(isset($subscription->status) &&
                                            $subscription->status === 'canceled' &&
                                            isset($subscription->expires_at) &&
                                            $subscription->expires_at > now())
                                        <form method="POST" action="{{ route('billing.subscription.resume') }}"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white  rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                                Reactivate Subscription
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-900 mb-3">No Active Subscription</h2>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto">Start your creative journey today with one
                                    of our premium plans designed for creators like you.</p>
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white  rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Explore Plans
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Subscriptions Tab Content -->
                    <div id="subscriptions-content" class="tab-content hidden p-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h2 class="text-sm text-gray-900 flex items-center">
                                    <svg class="w-6 h-6 text-indigo-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                    Available Plans
                                </h2>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto border-collapse">
                                    <thead>
                                        <tr
                                            class="bg-indigo-50 text-left text-xs  text-indigo-600 uppercase tracking-wider">
                                            <th class="px-6 py-4 border-b border-indigo-100">Plan</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Price</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Download</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @if (isset($plans) && $plans->count() > 0)
                                            @foreach ($plans as $plan)
                                                <tr class="border-b border-indigo-100 hover:bg-gray-50">
                                                    <td class="px-6 py-4 border-b border-indigo-100">
                                                        <div class="font-medium text-gray-900">
                                                            {{ $plan->name ?? 'N/A' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 border-b border-indigo-100">
                                                        <div class="text-gray-900">
                                                            ${{ isset($plan->monthly_price) ? number_format($plan->monthly_price, 2) : '0.00' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 border-b border-indigo-100">
                                                        <div class="text-gray-700">
                                                            {{ $plan->monthly_download_limit ?? 'Unlimited' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 border-b border-indigo-100">
                                                        <form method="POST" action="{{ route('checkout', $plan->id) }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white  rounded-lg transition-colors duration-200">
                                                                Payment
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="px-6 py-8 text-center text-gray-500" colspan="4">
                                                    No subscription plans available at the moment.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Billing History Tab Content -->
                    <div id="billing-history-content" class="tab-content hidden p-8">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <h2 class="text-sm text-gray-900 flex items-center">
                                    <svg class="w-6 h-6 text-indigo-500 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Payment History
                                </h2>
                            </div>

                            @if (isset($paymentLogs) && $paymentLogs->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Date</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Amount</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Status</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Type</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Gateway</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs  text-gray-600 uppercase tracking-wider">
                                                    Card Number</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-100">
                                            @foreach ($paymentLogs as $log)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ isset($log->created_at) ? $log->created_at->format('M j, Y') : 'N/A' }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ isset($log->created_at) ? $log->created_at->format('g:i A') : '' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm  text-gray-900">
                                                            @if (isset($log->amount) && $log->amount)
                                                                ${{ number_format($log->amount, 2) }}
                                                            @else
                                                                <span class="text-gray-400">--</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span
                                                            class="px-3 py-1 rounded-full text-xs 
                                                            @if (isset($log->status) && $log->status === 'success') bg-green-100 text-green-700 border border-green-200
                                                            @elseif(isset($log->status) && $log->status === 'failed') bg-red-100 text-red-700 border border-red-200
                                                            @elseif(isset($log->status) && $log->status === 'cancelled') bg-yellow-100 text-yellow-700 border border-yellow-200
                                                            @else bg-gray-100 text-gray-700 border border-gray-200 @endif">
                                                            {{ isset($log->status) ? ucfirst($log->status) : 'Unknown' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 capitalize">
                                                            {{ isset($log->transaction_type) ? ucfirst(str_replace('_', ' ', $log->transaction_type)) : 'N/A' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ $log->payment_method ?? 'N/A' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center space-x-2">
                                                            <div class="text-sm text-gray-900">
                                                                {{ isset($log->card_brand) && $log->card_brand ? ucfirst($log->card_brand) : '' }}
                                                                {{ isset($log->card_last_4) && $log->card_last_4 ? '**** ' . $log->card_last_4 : 'N/A' }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Enhanced Pagination -->
                                <div class="px-6 py-4 border-t border-gray-100">
                                    {{ $paymentLogs->links() }}
                                </div>
                            @else
                                <div class="text-center py-16">
                                    <div
                                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg  text-gray-900 mb-2">No Payment History</h3>
                                    <p class="text-gray-500">Your payment transactions will appear here once you make a
                                        purchase.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showTab(tabName) {
                // Hide all tab contents with smooth transition
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.add('hidden');
                });


                // Show the selected tab content
                const targetContent = document.getElementById(tabName + '-content');
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }

                // Reset all tab buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('border-indigo-500', 'text-indigo-600');
                    btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                        'hover:border-gray-200');

                    // Remove active indicator
                    const indicator = btn.querySelector('.absolute');
                    if (indicator) {
                        indicator.classList.add('hidden');
                    }
                });

                // Highlight the selected tab button
                const activeTab = document.getElementById(tabName + '-tab');
                if (activeTab) {
                    activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                        'hover:border-gray-200');
                    activeTab.classList.add('border-indigo-500', 'text-indigo-600');

                    // Show active indicator
                    const indicator = activeTab.querySelector('.absolute');
                    if (indicator) {
                        indicator.classList.remove('hidden');
                    }
                }
            }

            // Add some smooth animations on load
            document.addEventListener('DOMContentLoaded', function() {
                // Animate cards in
                const cards = document.querySelectorAll('.bg-white');
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.transition = 'all 0.5s ease-out';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        </script>

    </x-app-layout>
@endsection
