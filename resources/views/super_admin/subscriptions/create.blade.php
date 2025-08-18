<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('subscriptions.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User Selection -->
                            <div>
                                <x-label for="user_id" :value="__('User')" />
                                <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Plan Selection -->
                            <div>
                                <x-label for="plan_id" :value="__('Plan')" />
                                <select id="plan_id" name="plan_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Plan</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->name }} ({{ $plan->price }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('plan_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Billing Cycle -->
                            <div>
                                <x-label for="billing_cycle" :value="__('Billing Cycle')" />
                                <select id="billing_cycle" name="billing_cycle" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ old('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                </select>
                                @error('billing_cycle')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Amount Paid -->
                            <div>
                                <x-label for="amount_paid" :value="__('Amount Paid')" />
                                <input id="amount_paid" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid', 0) }}" placeholder="Enter amount paid" required />
                                @error('amount_paid')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Starts At -->
                            <div>
                                <x-label for="starts_at" :value="__('Start Date')" />
                                <input id="starts_at" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="datetime-local" name="starts_at" value="{{ old('starts_at', now()->format('Y-m-d\TH:i')) }}" placeholder="Start date" required />
                                @error('starts_at')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expires At -->
                            <div>
                                <x-label for="expires_at" :value="__('Expiry Date')" />
                                <input id="expires_at" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="datetime-local" name="expires_at" value="{{ old('expires_at', now()->addMonth()->format('Y-m-d\TH:i')) }}" placeholder="Expiry date" />
                                @error('expires_at')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Downloads Used -->
                            <div>
                                <x-label for="downloads_used" :value="__('Downloads Used')" />
                                <input id="downloads_used" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="downloads_used" value="{{ old('downloads_used', 0) }}" placeholder="Enter downloads used" required />
                                @error('downloads_used')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <x-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <x-label for="payment_method" :value="__('Payment Method')" />
                                <input id="payment_method" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="payment_method" value="{{ old('payment_method') }}" placeholder="e.g. Credit Card, PayPal" />
                                @error('payment_method')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment ID -->
                            <div>
                                <x-label for="payment_id" :value="__('Payment ID')" />
                                <input id="payment_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="payment_id" value="{{ old('payment_id') }}" placeholder="e.g. 12345678"/>
                                @error('payment_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('subscriptions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Create Subscription') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate expiry date based on billing cycle
        document.addEventListener('DOMContentLoaded', function() {
            const billingCycleSelect = document.getElementById('billing_cycle');
            const startsAtInput = document.getElementById('starts_at');
            const expiresAtInput = document.getElementById('expires_at');
            
            function updateExpiryDate() {
                const startsAt = new Date(startsAtInput.value);
                if (isNaN(startsAt.getTime())) return;
                
                let expiryDate = new Date(startsAt);
                if (billingCycleSelect.value === 'monthly') {
                    expiryDate.setMonth(expiryDate.getMonth() + 1);
                } else {
                    expiryDate.setFullYear(expiryDate.getFullYear() + 1);
                }
                
                // Format to YYYY-MM-DDTHH:MM
                const formattedDate = expiryDate.getFullYear() + '-' + 
                    String(expiryDate.getMonth() + 1).padStart(2, '0') + '-' + 
                    String(expiryDate.getDate()).padStart(2, '0') + 'T' + 
                    String(expiryDate.getHours()).padStart(2, '0') + ':' + 
                    String(expiryDate.getMinutes()).padStart(2, '0');
                
                expiresAtInput.value = formattedDate;
            }
            
            billingCycleSelect.addEventListener('change', updateExpiryDate);
            startsAtInput.addEventListener('change', updateExpiryDate);
        });
    </script>
</x-app-layout>