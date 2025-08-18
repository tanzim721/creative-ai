<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">

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
                    <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}'s Account Details</h3>
                </div>

                <!-- User Profile Information -->
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-medium text-gray-700">Profile Information</h4>
                            <div class="mt-2 space-y-2">
                                <p><span class="font-medium">Name:</span> {{ $user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                                <p><span class="font-medium">Company:</span> {{ $user->company_name }}</p>
                                <p><span class="font-medium">Phone:</span> {{ $user->mobile ?? 'Not provided' }}</p>
                                <p><span class="font-medium">Address:</span> {{ $user->company_address }}</p>
                                <p><span class="font-medium">Joined:</span> {{ $user->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700">Account Statistics</h4>
                            <div class="mt-2 space-y-2">
                                <p><span class="font-medium">Total Downloads:</span> {{ $totalDownloads }}</p>
                                <p><span class="font-medium">Subscription Status:</span>
                                    @if ($activeSubscription)
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $activeSubscription->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($activeSubscription->status) }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">No Active
                                            Subscription</span>
                                    @endif
                                </p>
                                @if ($activeSubscription)
                                    <p><span class="font-medium">Current Plan:</span>
                                        {{ $activeSubscription->plan->name ?? 'N/A' }}</p>
                                    <p><span class="font-medium">Billing Cycle:</span>
                                        {{ ucfirst($activeSubscription->billing_cycle) }}</p>
                                    <p><span class="font-medium">Expires:</span>
                                        {{ $activeSubscription->expires_at ? $activeSubscription->expires_at->format('M d, Y') : 'N/A' }}
                                    </p>
                                    {{-- <p><span class="font-medium">Downloads Used:</span>
                                        {{ $activeSubscription->downloads_used }} /
                                        {{ $activeSubscription->plan->download_limit ?? 'Unlimited' }}
                                    </p> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs for different sections -->
                <div class="border-b border-gray-200 ms-3">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button onclick="showTab('downloads')" id="downloads-tab"
                            class="tab-btn border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Downloads History
                        </button>
                        <button onclick="showTab('subscriptions')" id="subscriptions-tab"
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm ml-8">
                            Subscription History
                        </button>
                        <button onclick="showTab('creatives')" id="creatives-tab"
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm ml-8">
                            Creatives
                        </button>
                    </nav>
                </div>

                <!-- Downloads Tab Content -->
                <div id="downloads-content" class="tab-content">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Content Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Download Count
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subscription
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($user->downloads as $download)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $download->created_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $download->content_type ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $download->download_count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($download->subscription)->plan->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No download records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Subscriptions Tab Content -->
                <div id="subscriptions-content" class="tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Plan
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Start Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Expiry Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount Paid
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Downloads Used
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($user->subscriptions as $subscription)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($subscription->plan)->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $subscription->starts_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ${{ number_format($subscription->amount_paid, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full 
                                                {{ $subscription->status == 'active'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($subscription->status == 'expired'
                                                        ? 'bg-red-100 text-red-800'
                                                        : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($subscription->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $subscription->downloads_used }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No subscription records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Creatives Tab Content -->
                <div id="creatives-content" class="tab-content hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Creative Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($user->creatives as $creative)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $creative->creative_name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $creative->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('carousel.show', $creative->id) }}"
                                                class="px-3 py-1.5 bg-indigo-600 text-white rounded-md transition duration-150 ease-in-out items-center"
                                                target="_blank">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No creative records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                {{-- {{ $user->creatives->links() }} --}}
                            </div>
                        </table>
                    </div>
                </div>

                {{-- Pagination if needed --}}
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{-- Add pagination here if needed --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById(tabName + '-content').classList.remove('hidden');

            // Reset all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-600');
                btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700',
                    'hover:border-gray-300');
            });

            // Highlight the selected tab button
            document.getElementById(tabName + '-tab').classList.remove('border-transparent', 'text-gray-500',
                'hover:text-gray-700', 'hover:border-gray-300');
            document.getElementById(tabName + '-tab').classList.add('border-indigo-500', 'text-indigo-600');
        }
    </script>
</x-app-layout>
