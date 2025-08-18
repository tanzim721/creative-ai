<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="w-full flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 flex-shrink-0">
                            {{ $isEdit ? 'Edit Promo Code' : 'Create New Promo Code' }}
                        </h3>
                        <a href="{{ route('promocodes.index') }}" class="ml-auto px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Back to List
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-md p-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $isEdit ? route('promocodes.update', $promoCode) : route('promocodes.store') }}" method="POST" class="space-y-6">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Promo Code</label>
                                <input type="text" id="code" name="code" value="{{ old('code', $isEdit ? $promoCode->code : '') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('code') border-red-500 @enderror">
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Discount Type</label>
                                <select id="type" name="type" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('type') border-red-500 @enderror">
                                    <option value="fixed" {{ old('type', $isEdit ? $promoCode->type : '') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                    {{-- <option value="percentage" {{ old('type', $isEdit ? $promoCode->type : '') == 'percentage' ? 'selected' : '' }}>Percentage</option> --}}
                                    <option value="free" {{ old('type', $isEdit ? $promoCode->type : '') == 'free' ? 'selected' : '' }}>Free</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span id="value-prefix" class="text-gray-500 sm:text-sm">
                                            $
                                        </span>
                                    </div>
                                    <input type="number" step="0.01" min="0" id="value" name="value" 
                                        value="{{ old('value', $isEdit ? $promoCode->value : '0.00') }}" required
                                        class="w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('value') border-red-500 @enderror">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span id="value-suffix" class="text-gray-500 sm:text-sm">
                                            %
                                        </span>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Enter amount or percentage (based on discount type)</p>
                                @error('value')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="usage_limit" class="block text-sm font-medium text-gray-700 mb-1">Usage Limit</label>
                                <input type="number" min="0" id="usage_limit" name="usage_limit" 
                                    value="{{ old('usage_limit', $isEdit ? $promoCode->usage_limit : '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('usage_limit') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Leave empty for unlimited uses</p>
                                @error('usage_limit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                                <input type="datetime-local" id="start_time" name="start_time" 
                                    value="{{ old('start_time', $isEdit && $promoCode->start_time ? $promoCode->start_time->format('Y-m-d\TH:i') : '') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('start_time') border-red-500 @enderror">
                                @error('start_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                                <input type="datetime-local" id="end_time" name="end_time" 
                                    value="{{ old('end_time', $isEdit && $promoCode->end_time ? $promoCode->end_time->format('Y-m-d\TH:i') : '') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('end_time') border-red-500 @enderror">
                                @error('end_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_active" name="is_active" type="checkbox" value="1" 
                                    {{ old('is_active', $isEdit && $promoCode->is_active ? true : false) ? 'checked' : '' }}
                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-medium text-gray-700">Make Active</label>
                                <p class="text-gray-500">If checked, this promo code will be active.</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ $isEdit ? 'Update Promo Code' : 'Create Promo Code' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Dynamic UI for discount type/value
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const valueInput = document.getElementById('value');
            const valuePrefix = document.getElementById('value-prefix');
            const valueSuffix = document.getElementById('value-suffix');
            
            function updateValueDisplay() {
                const selectedType = typeSelect.value;
                
                if (selectedType === 'percentage') {
                    valuePrefix.style.display = 'none';
                    valueSuffix.style.display = 'block';
                    valueInput.disabled = false;
                } else if (selectedType === 'fixed') {
                    valuePrefix.style.display = 'block';
                    valueSuffix.style.display = 'none';
                    valueInput.disabled = false;
                } else if (selectedType === 'free') {
                    valuePrefix.style.display = 'none';
                    valueSuffix.style.display = 'none';
                    valueInput.value = '0';
                    valueInput.disabled = false;
                }
            }
            
            // Set initial state
            updateValueDisplay();
            
            // Update on change
            typeSelect.addEventListener('change', updateValueDisplay);
        });
    </script>
</x-app-layout>