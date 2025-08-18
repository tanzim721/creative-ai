<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 leading-tight">
                {{ __('Customer Management') }}
            </h1>
            <div class="mt-2 md:mt-0">
                <span class="text-sm text-gray-500">View and manage your customer database</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Alert (if needed) -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md"
                    role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <!-- Card Header -->
                <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h2 class="text-xl font-bold">{{ __('Customer Lists') }}</h2>
                        </div>

                    </div>
                </div>

                <!-- Enhanced Filter Form with better styling -->
                <div class="bg-gray-50 p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('admin.dashboard') }}" id="filter-form">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Company Name Filter -->
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company
                                    Name</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="company_name" name="company_name"
                                        value="{{ request('company_name') }}"
                                        class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Search by company...">
                                </div>
                            </div>

                            <!-- Contact Person Filter -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                    Person</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ request('name') }}"
                                        class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Search by contact name...">
                                </div>
                            </div>

                            <!-- Email Filter -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="email" name="email" value="{{ request('email') }}"
                                        class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Search by email...">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <select name="status" id="status"
                                        class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">All Statuses</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Filter Controls -->
                            <div class="flex items-end space-x-3 md:col-span-2 lg:col-span-4">
                                <button type="submit"
                                    class="flex-grow md:flex-grow-0 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Apply Filters
                                </button>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex-grow md:flex-grow-0 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition duration-150 ease-in-out flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Clear
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Pagination with improved styling -->
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
                <!-- Table with improved styling -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Company Name
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact Person
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mobile
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Register Date
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->company_name }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $user->mobile }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap max-w-xs truncate">
                                        <div class="text-sm text-gray-600">{{ $user->company_address }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $user->created_at->format('Y-m-d') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span id="status-{{ $user->id }}"
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                              {{ $user->role == 0 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role == 0 ? 'inactive' : 'active') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors duration-150"
                                            onclick="showEditModal({{ $user->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($users) == 0)
                                <tr>
                                    <td colspan="9" class="px-6 py-10 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            <p class="mt-2 text-gray-500">No customers found matching your criteria</p>
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="mt-3 text-indigo-600 hover:text-indigo-500">
                                                Clear filters and show all customers
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <!-- Improved Modal Design -->
    @foreach ($users as $user)
        <div id="edit-modal-{{ $user->id }}"
            class="fixed z-50 inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 transform transition-all scale-95 opacity-0"
                id="modal-content-{{ $user->id }}">
                <div class="text-center mb-5">
                    <h3 class="text-xl font-bold text-gray-900">
                        Update Customer Status
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">Change the active status for {{ $user->company_name }}</p>
                </div>
                <div class="mb-6">
                    <label for="user-role-{{ $user->id }}"
                        class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="user-role-{{ $user->id }}"
                        class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>
                            Active
                        </option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-150"
                        onclick="hideEditModal({{ $user->id }})">
                        Cancel
                    </button>
                    <button type="button"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150"
                        onclick="updateUserStatus({{ $user->id }})">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function showEditModal(userId) {
            const modal = document.getElementById(`edit-modal-${userId}`);
            const modalContent = document.getElementById(`modal-content-${userId}`);

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Animate in
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideEditModal(userId) {
            const modal = document.getElementById(`edit-modal-${userId}`);
            const modalContent = document.getElementById(`modal-content-${userId}`);

            // Animate out
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 150);
        }

        function updateUserStatus(userId) {
            let newStatus = document.getElementById(`user-role-${userId}`).value;
            let token = "{{ csrf_token() }}";

            fetch("{{ url('/change-status') }}/" + userId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const statusEl = document.getElementById(`status-${userId}`);

                        statusEl.textContent = data.statusText;

                        // Update status badge class
                        if (data.status === 1) {
                            statusEl.classList.remove('bg-red-100', 'text-red-800');
                            statusEl.classList.add('bg-green-100', 'text-green-800');
                        } else {
                            statusEl.classList.remove('bg-green-100', 'text-green-800');
                            statusEl.classList.add('bg-red-100', 'text-red-800');
                        }

                        hideEditModal(userId);

                        // Show success toast
                        showToast('Status updated successfully');
                    } else {
                        alert("Failed to update status.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Toast notification function
        function showToast(message) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className =
                'fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out translate-y-[-100%] opacity-0 z-50 flex items-center';
            toast.innerHTML = `
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                ${message}
            `;

            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-y-[-100%]', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
            }, 10);

            // Animate out after 3 seconds
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-[-100%]', 'opacity-0');

                // Remove from DOM after animation
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
    </script>

</x-app-layout>
