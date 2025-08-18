<x-app-layout>


    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">User Activities</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('activities.analytics') }}" class="btn btn-info">
                    <i class="fas fa-chart-bar"></i> Analytics
                </a>
                <form action="{{ route('activities.export') }}" method="GET" class="d-inline">
                    @foreach ($filters as $key => $value)
                        @if ($value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download"></i> Export CSV
                    </button>
                </form>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-primary mb-0">Today's Activities</h6>
                                <h3 class="mb-0">{{ number_format($stats['today_activities']) }}</h3>
                            </div>
                            <div class="text-primary">
                                <i class="fas fa-calendar-day fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-success mb-0">This Week</h6>
                                <h3 class="mb-0">{{ number_format($stats['week_activities']) }}</h3>
                            </div>
                            <div class="text-success">
                                <i class="fas fa-calendar-week fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-warning mb-0">This Month</h6>
                                <h3 class="mb-0">{{ number_format($stats['month_activities']) }}</h3>
                            </div>
                            <div class="text-warning">
                                <i class="fas fa-calendar-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="text-info mb-0">Active Users Today</h6>
                                <h3 class="mb-0">{{ number_format($stats['unique_users_today']) }}</h3>
                            </div>
                            <div class="text-info">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-filter"></i> Filters
                </h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('activities.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">User</label>
                            <select name="user_id" class="form-select">
                                <option value="">All Users</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ ($filters['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Activity Type</label>
                            <select name="activity_type" class="form-select">
                                <option value="">All Types</option>
                                @foreach ($activityTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ ($filters['activity_type'] ?? '') == $type ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $type)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control"
                                value="{{ $filters['date_from'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control"
                                value="{{ $filters['date_to'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Search..."
                                value="{{ $filters['search'] ?? '' }}">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times"></i> Clear Filters
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Activities Table --}}
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list"></i> Activities Log
                    <small class="text-muted">({{ $activities->total() }} total records)</small>
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Type</th>
                                <th>Page/Action</th>
                                <th>IP Address</th>
                                <th>Browser</th>
                                <th>Date/Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $activity->user_name }}</strong>
                                            @if ($activity->user)
                                                <br><small class="text-muted">{{ $activity->user->email }}</small>
                                            @endif
                                            @if ($activity->user_type === 'subuser')
                                                <span class="badge bg-info">Subuser</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $activity->activity_type === 'page_view' ? 'primary' : ($activity->activity_type === 'form_submission' ? 'success' : ($activity->activity_type === 'button_click' ? 'warning' : 'secondary')) }}">
                                            {{ ucwords(str_replace('_', ' ', $activity->activity_type)) }}
                                        </span>
                                    </td>
                                    <td>{{ ucwords(str_replace('_', ' ', $activity->activity_type)) }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $activity->activity_name }}</strong>
                                            @if ($activity->url)
                                                <br><small
                                                    class="text-muted">{{ Str::limit($activity->url, 50) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td><code>{{ $activity->ip_address }}</code></td>
                                    <td>
                                        <i class="fab fa-{{ strtolower($activity->browser) }}"></i>
                                        {{ $activity->browser }}
                                    </td>
                                    <td>
                                        <small>{{ $activity->formatted_created_at }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('activities.show', $activity->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">No activities found</h5>
                                            <p class="text-muted">Try adjusting your filters</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <small class="text-muted">
                            Showing {{ $activities->firstItem() }} to {{ $activities->lastItem() }} of
                            {{ $activities->total() }} results
                        </small>
                    </div>
                    <div>
                        {{ $activities->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Analytics Modal --}}
    <div class="modal fade" id="analyticsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quick Analytics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="analyticsContent">
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-refresh every 30 seconds if no filters are applied
                const hasFilters = {{ json_encode(array_filter($filters)) ? 'true' : 'false' }};

                if (!hasFilters) {
                    setInterval(function() {
                        window.location.reload();
                    }, 30000);
                }
            });
        </script>

</x-app-layout>
