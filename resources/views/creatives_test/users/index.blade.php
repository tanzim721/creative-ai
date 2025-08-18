@extends('creatives_test.layouts.app')

@section('title', 'Toucan Creative - Users')
@section('meta-description', 'Toucan Creative - Users')

@section('content')
    <x-app-layout>
        @if (auth()->user()->role == 1)
            <div class="dashboard">
                <div class="nav flex justify-between items-center text-white px-4 py-2 rounded-tl-xl rounded-tr-xl">
                    {{-- <p class="font-semibold hidden md:block" style="margin:0 auto;">Create creative with AI</p> --}}
                </div>
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>{{ __('Manage users') }}</span>
                                    <a href="{{ route('subusers.create') }}" class="btn btn-primary btn-sm">
                                        {{ __('Add New user') }}
                                    </a>
                                </div>
                
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                
                                    @if(count($subusers) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Position</th>
                                                        <th>Phone</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($subusers as $subuser)
                                                        <tr>
                                                            <td>{{ $subuser->name }}</td>
                                                            <td>{{ $subuser->email }}</td>
                                                            <td>{{ $subuser->position ?? 'N/A' }}</td>
                                                            <td>{{ $subuser->mobile ?? 'N/A' }}</td>
                                                            <td>
                                                                <span class="badge {{ $subuser->is_active ? 'bg-success' : 'bg-danger' }}">
                                                                    {{ $subuser->is_active ? 'Active' : 'Inactive' }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $subuser->created_at->format('M d, Y') }}</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="{{ route('subusers.edit', $subuser->id) }}" class="btn btn-primary btn-sm mx-1" title="Edit">
                                                                        <i class="fa fa-edit"></i> Edit
                                                                    </a>
                                                                    <form action="{{ route('subusers.toggle-status', $subuser->id) }}" method="POST" style="display: inline;" class="mx-1">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit" class="btn {{ $subuser->is_active ? 'btn-warning' : 'btn-success' }} btn-sm" title="{{ $subuser->is_active ? 'Deactivate' : 'Activate' }}">
                                                                            <i class="fa {{ $subuser->is_active ? 'fa-ban' : 'fa-check' }}"></i> {{ $subuser->is_active ? 'Deactivate' : 'Activate' }}
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ route('subusers.destroy', $subuser->id) }}" method="POST" style="display: inline;" class="mx-1" onsubmit="return confirm('Are you sure you want to delete this subuser?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                                            <i class="fa fa-trash"></i> Delete
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            You don't have any users yet. <a href="{{ route('subusers.create') }}">Create your first user</a>.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="dashboard">

            </div>
        @endif


        <script>
            function showEditModal(userId) {
                document.getElementById(`edit-modal-${userId}`).classList.remove('hidden');
                document.getElementById(`edit-modal-${userId}`).classList.add('flex');
            }
    
            function hideEditModal(userId) {
                document.getElementById(`edit-modal-${userId}`).classList.add('hidden');
            }
    
            function updateUserStatus(userId) {
                let newStatus = document.getElementById(`user-role-${userId}`).value;
                let token = "{{ csrf_token() }}";
    
                fetch("{{ url('/admin/change-status') }}/" + userId, {
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
                            document.getElementById(`status-${userId}`).textContent = data.statusText;
                            document.getElementById(`status-${userId}`).className = data.status === 1 ? "text-green-500" :
                                "text-red-500";
                            hideEditModal(userId);
                        } else {
                            alert("Failed to update status.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        </script>
        
    </x-app-layout>
@endsection
