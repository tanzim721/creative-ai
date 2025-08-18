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
                    
                </div>
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    
                </div>

                <div class="overflow-x-auto">
                    
                </div>

                {{-- Pagination --}}
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>