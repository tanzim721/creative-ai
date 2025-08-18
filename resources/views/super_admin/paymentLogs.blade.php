@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative || Payment Logs')

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 2)
            <div class="min-h-screen via-blue-50 to-indigo-50 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Success Alert -->
                    @if (session('success'))
                        <div class="mb-8 relative">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white px-6 py-4 rounded-2xl shadow-lg border border-emerald-200 backdrop-blur-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Page Header -->
                    <div class="mb-8 bg-white/80 backdrop-blur-sm border border-white/20 shadow-2xl rounded-3xl overflow-hidden p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-indigo-800 bg-clip-text text-transparent">
                                    Payment Logs
                                </h1>
                                <p class="mt-2 text-lg text-gray-600">Monitor and manage all payment transactions</p>
                            </div>
                            <div class="hidden md:block">
                                <div class="flex items-center space-x-1">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-sm font-medium text-gray-600">Live Dashboard</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Total Logs Card -->
                        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 group-hover:from-blue-500/10 group-hover:to-indigo-500/10 transition-all duration-300"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Total Logs</p>
                                        <p class="text-3xl font-bold text-gray-900">{{ number_format($totalLogs) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Successful Transactions Card -->
                        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-pink-500/5 group-hover:from-purple-500/10 group-hover:to-pink-500/10 transition-all duration-300"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Successful</p>
                                        <p class="text-3xl font-bold text-purple-600">{{ number_format($successfulTransactions) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" 
                                             style="width: {{ $totalLogs > 0 ? ($successfulTransactions / $totalLogs) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Card -->
                        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-teal-500/5 group-hover:from-emerald-500/10 group-hover:to-teal-500/10 transition-all duration-300"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Total Revenue</p>
                                        <p class="text-3xl font-bold text-emerald-600">${{ number_format($totalRevenue, 2) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Card -->
                    <div class="bg-white/80 backdrop-blur-sm border border-white/20 shadow-2xl rounded-3xl overflow-hidden">
                        
                        <!-- Filters Section -->
                        <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 backdrop-blur-sm px-8 py-6 border-b border-gray-200/50">
                            <form method="GET" action="{{ route('payment.logs') }}" class="space-y-4 lg:space-y-0 lg:flex lg:items-center lg:space-x-6">
                                
                                <!-- Search Input -->
                                <div class="relative flex-1 lg:max-w-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="search" name="search" placeholder="Search users..."
                                        value="{{ request('search') }}"
                                        class="block w-full pl-12 pr-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 placeholder-gray-400">
                                </div>

                                <!-- Status Filter -->
                                <div class="relative lg:w-48">
                                    <select name="status" class="block w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none cursor-pointer">
                                        <option value="">All Status</option>
                                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                                    
                                <!-- Payment Method Filter -->
                                <div class="relative lg:w-48">
                                    <select name="payment_method" class="block w-full px-4 py-3 bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 appearance-none cursor-pointer">
                                        <option value="">All Methods</option>
                                        <option value="stripe" {{ request('payment_method') == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center space-x-3">
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                        </svg>
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('payment.logs') }}"
                                        class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500/20 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- Table -->
                        <div class="overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                        <tr>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                #
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                User
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                Plan
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                Amount
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                Status
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                Payment Method
                                            </th>
                                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider border-b border-gray-200/50">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white/50 backdrop-blur-sm">
                                        @forelse ($paymentLogs as $index => $paymentLog)
                                            <tr class="hover:bg-blue-50/50 transition-all duration-200 border-b border-gray-100/50 group">
                                                <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                                    <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg text-xs font-bold text-gray-600 group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-blue-700 transition-all duration-200">
                                                        {{ $paymentLogs->firstItem() + $index }}
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    @if($paymentLog->user)
                                                        <div class="flex items-center space-x-4">
                                                            <div class="flex-shrink-0 h-12 w-12">
                                                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                                                                    <span class="text-sm font-bold text-white">
                                                                        {{ strtoupper(substr($paymentLog->user->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="min-w-0 flex-1">
                                                                <div class="text-sm font-semibold text-gray-900 truncate">
                                                                    {{ $paymentLog->user->name }}
                                                                </div>
                                                                <div class="text-sm text-gray-500 truncate">
                                                                    {{ $paymentLog->user->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="text-sm text-gray-400 italic flex items-center">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                            </svg>
                                                            User not found
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    @if($paymentLog->plan)
                                                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                                            <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            {{ $paymentLog->plan->name }}
                                                        </span>
                                                    @else
                                                        <span class="text-sm text-gray-400">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    @if($paymentLog->amount)
                                                        <div class="flex items-center">
                                                            <span class="text-lg font-bold text-gray-900">${{ number_format($paymentLog->amount, 2) }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-sm text-gray-400">N/A</span>
                                                    @endif
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    @php
                                                        $statusConfig = [
                                                            'success' => ['bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border-emerald-200', 'Success', 'text-emerald-600'],
                                                            'pending' => ['bg-gradient-to-r from-amber-100 to-yellow-100 text-amber-800 border-amber-200', 'Pending', 'text-amber-600'],
                                                            'cancelled' => ['bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border-red-200', 'Cancelled', 'text-red-600'],
                                                            'failed' => ['bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border-red-200', 'Failed', 'text-red-600']
                                                        ];
                                                        $config = $statusConfig[strtolower($paymentLog->status)] ?? ['bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border-gray-200', ucfirst($paymentLog->status), 'text-gray-600'];
                                                    @endphp
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold border {{ $config[0] }}">
                                                        <div class="w-2 h-2 {{ $config[2] }} bg-current rounded-full mr-2"></div>
                                                        {{ $config[1] }}
                                                    </span>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @if($paymentLog->payment_method == 'stripe')
                                                            <div class="flex items-center space-x-2">
                                                                <div class="p-2 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg">
                                                                    <svg class="w-4 h-4 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                                                        <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.594-7.305h.003z"/>
                                                                    </svg>
                                                                </div>
                                                                <span class="text-sm font-semibold text-gray-900">Stripe</span>
                                                            </div>
                                                        @else
                                                            <span class="text-sm font-semibold text-gray-900 capitalize">{{ $paymentLog->payment_method }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $paymentLog->created_at->format('M d, Y') }}</div>
                                                    <div class="text-xs text-gray-500">{{ $paymentLog->created_at->format('H:i A') }}</div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-8 py-16 text-center">
                                                    <div class="flex flex-col items-center justify-center space-y-6">
                                                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                            </svg>
                                                        </div>
                                                        <div class="text-center max-w-md">
                                                            <h3 class="text-xl font-semibold text-gray-900 mb-3">No payment logs found</h3>
                                                            <p class="text-gray-500 leading-relaxed">
                                                                @if(request()->hasAny(['search', 'status', 'payment_method', 'date_from', 'date_to']))
                                                                    No results match your current filters. Try adjusting your search criteria to find what you're looking for.
                                                                @else
                                                                    Payment logs will appear here once transactions are processed. All your payment data will be tracked and displayed in this dashboard.
                                                                @endif
                                                            </p>
                                                            @if(request()->hasAny(['search', 'status', 'payment_method', 'date_from', 'date_to']))
                                                                                                                                <a href="{{ route('payment.logs') }}"
                                                                    class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                                    </svg>
                                                                    Clear All Filters
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Enhanced Pagination -->
                        @if($paymentLogs->hasPages())
                            <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 px-8 py-6 border-t border-gray-200/50">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        @if ($paymentLogs->onFirstPage())
                                            <span class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-xl">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Previous
                                            </span>
                                        @else
                                            <a href="{{ $paymentLogs->appends(request()->query())->previousPageUrl() }}" 
                                               class="relative inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                                Previous
                                            </a>
                                        @endif

                                        @if ($paymentLogs->hasMorePages())
                                            <a href="{{ $paymentLogs->appends(request()->query())->nextPageUrl() }}" 
                                               class="relative inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg">
                                                Next
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <span class="relative inline-flex items-center px-6 py-3 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-xl">
                                                Next
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div class="bg-white/70 backdrop-blur-sm px-4 py-2 rounded-xl border border-gray-200">
                                            <p class="text-sm text-gray-700 font-medium">
                                                Showing
                                                <span class="font-bold text-gray-900">{{ $paymentLogs->firstItem() }}</span>
                                                to
                                                <span class="font-bold text-gray-900">{{ $paymentLogs->lastItem() }}</span>
                                                of
                                                <span class="font-bold text-gray-900">{{ $paymentLogs->total() }}</span>
                                                results
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            {{ $paymentLogs->appends(request()->query())->links('pagination::tailwind') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
           
        @endif
    </x-app-layout>
@endsection