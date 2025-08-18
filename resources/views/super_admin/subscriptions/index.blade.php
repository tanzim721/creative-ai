<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Subscriptions Management') }}
            </h2>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <a href="{{ route('subscriptions.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add New Subscription
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center py-3 px-3">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Subscriptions') }}
                    </h2>
                    <a href="{{ route('subscriptions.create') }}"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add Subscription') }}
                    </a>
                </div>
                {{-- Search and Filter Section --}}
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <form method="GET" action="{{ route('subscriptions.index') }}"
                        class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                        <div class="flex-grow">
                            <input type="search" name="search" placeholder="Search by user name or email"
                                value="{{ request('search') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <select name="status"
                                class="w-full px-5 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>
                                    Expired</option>
                                <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>
                                    Canceled</option>
                            </select>
                        </div>
                        <div>
                            <select name="billing_cycle"
                                class="w-full px-5 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">All Billing Cycles</option>
                                <option value="monthly" {{ request('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ request('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            </select>
                        </div>
                        <div>
                            <select name="plan_id"
                                class="w-full px-5 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">All Plans</option>
                                @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Apply Filters
                        </button>
                    </form>
                </div>

                {{-- Subscriptions Table --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Customer
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Plan
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Billing Cycle
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Amount Paid
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Payment Method
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Downloads Used
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Valid Until
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($subscriptions as $subscription)
                                <tr>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $subscription->id }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $subscription->user->name ?? 'N/A' }} <br>
                                        <span class="text-xs text-gray-500">{{ $subscription->user->email ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $subscription->plan->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="capitalize">{{ $subscription->billing_cycle }}</span>
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $subscription->getFormattedAmountPaid() }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ strtoupper($subscription->payment_method ?? 'N/A') }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $subscription->downloads_used }}
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($subscription->expires_at)
                                            {{ $subscription->expires_at->format('M d, Y') }}
                                            <br>
                                            <span class="text-xs {{ $subscription->isExpired() ? 'text-red-500' : 'text-gray-500' }}">
                                                {{ (int) $subscription->getRemainingDays() }} days left
                                            </span>
                                        @else
                                            <span class="text-gray-500">Never</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        @if($subscription->status == 'active')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @elseif($subscription->status == 'expired')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Expired
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Canceled
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            {{-- <a href="{{ route('subscriptions.show', $subscription) }}"
                                                class="text-indigo-600 hover:text-indigo-900">View</a> --}}
                                            <a href="{{ route('subscriptions.edit', $subscription) }}"
                                                class="text-green-600 hover:text-green-900">Edit</a>
                                            
                                            @if($subscription->status == 'active')
                                            <form method="POST" action="{{ route('subscriptions.cancel', $subscription) }}"
                                                onsubmit="return confirm('Are you sure you want to cancel this subscription?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-orange-600 hover:text-orange-900">
                                                    Cancel
                                                </button>
                                            </form>
                                            @elseif($subscription->status == 'expired' || $subscription->status == 'canceled')
                                            <button type="button" 
                                                class="text-blue-600 hover:text-blue-900"
                                                onclick="document.getElementById('renew-modal-{{ $subscription->id }}').classList.remove('hidden')">
                                                Renew
                                            </button>
                                            @endif
                                            
                                            <form method="POST" action="{{ route('subscriptions.destroy', $subscription) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this subscription?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- Renew Modal -->
                                        <div id="renew-modal-{{ $subscription->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                <div class="mt-3 text-center">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Renew Subscription</h3>
                                                    <div class="mt-2 px-7 py-3">
                                                        <form method="POST" action="{{ route('subscriptions.renew', $subscription) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="mb-4">
                                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                                                                    Duration (in {{ $subscription->billing_cycle == 'monthly' ? 'months' : 'years' }})
                                                                </label>
                                                                <input 
                                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                                                    id="duration" 
                                                                    name="duration" 
                                                                    type="number" 
                                                                    value="1" 
                                                                    min="1"
                                                                >
                                                            </div>
                                                            <div class="flex items-center justify-between">
                                                                <button type="button" onclick="document.getElementById('renew-modal-{{ $subscription->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                                                    Renew
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No subscriptions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{-- {{ $subscriptions->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>