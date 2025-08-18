@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative - Downloads')
@section('meta-description', 'Toucan Creative - Downloads Dashboard')

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 1)
            <div class="dashboard bg-gray-50 min-h-screen py-8" style="font-size: 0.8rem;">
                <div class="container">
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
                                <h5 class="text-sm text-white">Download Analytics</h5>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                            <!-- Total Downloads Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-indigo-50 p-6 transform transition duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-blue-100 p-2 mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Downloads</p>
                                        @php
                                            $totalDownloads = $downloadCount->sum('download_count');
                                            $totalLimit = 0;
                                            $usagePercentage = 0;
                                            
                                            if (!$downloadCount->isEmpty()) {
                                                $firstSubscription = $downloadCount->first()->subscription;
                                                $totalLimit = $firstSubscription->billing_cycle == "monthly" 
                                                    ? $firstSubscription->plan->monthly_download_limit 
                                                    : $firstSubscription->plan->yearly_download_limit;
                                                $usagePercentage = $totalLimit > 0 ? ceil(($totalDownloads / $totalLimit) * 100) : 0;
                                            }
                                        @endphp
                                        <p class="text-sm text-gray-800 mt-1">
                                            {{ number_format($totalDownloads) }}
                                            @if($totalLimit > 0)
                                                <span class="text-sm text-gray-500">/ {{ number_format($totalLimit) }}</span>
                                            @endif
                                        </p>
                                        <p class="text-xs mt-1 font-medium flex items-center {{ $usagePercentage > 80 ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $usagePercentage }}% used
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Customers Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-indigo-50 p-6 transform transition duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-green-100 p-2 mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Users</p>
                                        <p class="text-sm text-gray-800 mt-1">{{ $downloadCount->unique('user.id')->count() }}</p>
                                        <p class="text-xs text-green-600 mt-1 font-medium">This month</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Revenue Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-indigo-50 p-6 transform transition duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-yellow-100 p-2 mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Cost</p>
                                        <p class="text-sm text-gray-800 mt-1">
                                            ${{ number_format($downloadCount->sum('subscription.amount_paid'), 2) }}
                                        </p>
                                        <p class="text-xs text-green-600 mt-1 font-medium">
                                          
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Types Card -->
                            <div class="bg-white rounded-xl shadow-lg border border-indigo-50 p-6 transform transition duration-300 hover:shadow-xl hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-purple-100 p-2 mr-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Creative Types</p>
                                        <p class="text-sm text-gray-800 mt-1">{{ $downloadCount->unique('content_type')->count() }}</p>
                                        {{-- <p class="text-xs text-purple-600 mt-1 font-medium">Available</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Downloads Table -->
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-indigo-50">
                            <div class="border-b border-indigo-50 bg-white py-6 px-8">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <h2 class="text-sm text-gray-800">Recent Download Activity</h2>
                                    <div class="mt-4 md:mt-0">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="searchInput" placeholder="Search downloads..." class="block w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto border-collapse">
                                    <thead>
                                        <tr class="bg-indigo-50 text-left text-xs font-semibold text-indigo-600 uppercase tracking-wider">
                                            <th class="px-6 py-4 border-b border-indigo-100">Customer</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Email</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Subscription</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Creative Type</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Downloads</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Status</th>
                                            <th class="px-6 py-4 border-b border-indigo-100">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @forelse ($downloadCount as $index => $download)
                                            <tr class="hover:bg-indigo-50 transition-colors duration-150 ease-in-out">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-medium">
                                                                {{ substr($download->user->name ?? 'N/A', 0, 1) }}
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-semibold text-gray-900">{{ $download->user->name ?? 'N/A' }}</div>
                                                            <div class="text-xs text-gray-500">Customer ID: #{{ $download->user->id ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $download->user->email ?? 'N/A' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $subscriptionName = $download->subscription->plan->name ?? 'N/A';
                                                        $billingCycle = $download->subscription->billing_cycle ?? 'N/A';
                                                        $bgColor = 'bg-blue-100';
                                                        $textColor = 'text-blue-800';
                                                        
                                                        
                                                    @endphp
                                                    <div class="flex flex-col">
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bgColor }} {{ $textColor }} mb-1">
                                                            {{ $subscriptionName }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 capitalize ps-3">{{ $billingCycle }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    @php
                                                        $contentType = $download->content_type ?? 'N/A';
                                                        $icon = 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z';
                                                        
                                                        if (stripos($contentType, 'image') !== false || stripos($contentType, 'photo') !== false) {
                                                            $icon = 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z';
                                                        } elseif (stripos($contentType, 'video') !== false) {
                                                            $icon = 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z';
                                                        } elseif (stripos($contentType, 'audio') !== false) {
                                                            $icon = 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3';
                                                        }
                                                    @endphp
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
                                                        </svg>
                                                        {{ $contentType }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        <span class="text-sm font-medium text-gray-900">{{ number_format($download->download_count) }}</span>
                                                        @if(isset($download->subscription->downloads_used))
                                                            <span class="text-xs text-gray-500 ml-2">/ {{ number_format($download->subscription->downloads_used) }}</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $status = $download->subscription->status ?? 'unknown';
                                                        $statusColor = 'bg-gray-100 text-gray-800';
                                                        
                                                        switch($status) {
                                                            case 'active':
                                                                $statusColor = 'bg-green-100 text-green-800';
                                                                break;
                                                            case 'expired':
                                                                $statusColor = 'bg-red-100 text-red-800';
                                                                break;
                                                            case 'pending':
                                                                $statusColor = 'bg-yellow-100 text-yellow-800';
                                                                break;
                                                            case 'cancelled':
                                                                $statusColor = 'bg-gray-100 text-gray-800';
                                                                break;
                                                        }
                                                    @endphp
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    <div class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $download->created_at->format('Y-m-d') }}
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-6 py-10 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                        </svg>
                                                        <p class="text-xl text-gray-500 font-medium mb-2">No downloads found</p>
                                                        <p class="text-gray-400 text-base max-w-sm text-center">Downloads will appear here once customers start downloading content from your platform</p>
                                                        <button class="mt-6 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-150 ease-in-out shadow-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                            </svg>
                                                            Refresh Data
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            @if(count($downloadCount) > 0)
                                <div class="px-8 py-6 bg-white border-t border-indigo-50 flex flex-col md:flex-row items-center justify-between">
                                    <div class="text-sm text-gray-600 mb-4 md:mb-0">
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">{{ count($downloadCount) }}</span> of <span class="font-medium">{{ count($downloadCount) }}</span> results
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150 ease-in-out" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                            Previous
                                        </button>
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150 ease-in-out" disabled>
                                            Next
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
           

            <!-- Add some JavaScript for search functionality -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const tableRows = document.querySelectorAll('tbody tr');
                    
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.toLowerCase();
                        
                        tableRows.forEach(row => {
                            const text = row.textContent.toLowerCase();
                            if (text.includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                });
            </script>
        @else
            <div class="dashboard bg-gray-50 min-h-screen flex items-center justify-center">
                <div class="text-center p-8 max-w-md">
                    <div class="bg-white rounded-xl shadow-lg border border-indigo-50 p-10">
                        <div class="rounded-full bg-red-100 h-20 w-20 flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-sm text-gray-800 mb-3">Access Restricted</h2>
                        <p class="text-gray-600 mb-6">You don't have permission to view this page. Please contact an administrator if you believe this is an error.</p>
                        <a href="{{ route('dashboard') }}" class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg transition-colors duration-200 shadow-md">
                            Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </x-app-layout>
@endsection