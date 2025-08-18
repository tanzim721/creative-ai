<x-app-layout>

    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Activity Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('activities.index') }}">Activities</a></li>
                        <li class="breadcrumb-item active">Activity #{{ $activity->id }}</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Activities
            </a>
        </div>

        <div class="row">
            {{-- Main Activity Details --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle"></i> Activity Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Activity ID:</th>
                                        <td><code>{{ $activity->id }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>User:</th>
                                        <td>
                                            <strong>{{ $activity->user_name }}</strong>
                                            @if ($activity->user)
                                                <br><small class="text-muted">{{ $activity->user->email }}</small>
                                            @endif
                                            @if ($activity->user_type === 'subuser')
                                                <span class="badge bg-info ms-2">Subuser</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Activity Type:</th>
                                        <td>
                                            <span
                                                class="badge bg-{{ $activity->activity_type === 'page_view' ? 'primary' : ($activity->activity_type === 'form_submission' ? 'success' : ($activity->activity_type === 'button_click' ? 'warning' : 'secondary')) }} fs-6">
                                                {{ ucwords(str_replace('_', ' ', $activity->activity_type)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Activity Name:</th>
                                        <td><strong>{{ $activity->activity_name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>HTTP Method:</th>
                                        <td>
                                            <span
                                                class="badge bg-{{ $activity->method === 'GET' ? 'success' : ($activity->method === 'POST' ? 'warning' : 'danger') }}">
                                                {{ $activity->method }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Date/Time:</th>
                                        <td>{{ $activity->formatted_created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>IP Address:</th>
                                        <td><code>{{ $activity->ip_address }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Browser:</th>
                                        <td>
                                            <i class="fab fa-{{ strtolower($activity->browser) }}"></i>
                                            {{ $activity->browser }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Session ID:</th>
                                        <td><code>{{ Str::limit($activity->session_id, 20) }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>URL:</th>
                                        <td>
                                            @if ($activity->url)
                                                <a href="{{ $activity->url }}" target="_blank" class="text-break">
                                                    {{ $activity->url }}
                                                    <i class="fas fa-external-link-alt ms-1"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metadata Section --}}
                @if ($activity->metadata)
                    <div class="card mt-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-database"></i> Additional Data
                            </h5>
                        </div>
                        <div class="card-body">
                            <pre class="bg-light p-3 rounded"><code>{{ json_encode($activity->metadata, JSON_PRETTY_PRINT) }}</code></pre>
                        </div>
                    </div>
                @endif

                {{-- User Agent Details --}}
                @if ($activity->user_agent)
                    <div class="card mt-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-desktop"></i> User Agent
                            </h5>
                        </div>
                        <div class="card-body">
                            <code class="text-break">{{ $activity->user_agent }}</code>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-md-4">
                {{-- User Summary --}}
                @if ($activity->user)
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user"></i> User Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-user fa-2x text-white"></i>
                                </div>
                            </div>
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $activity->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $activity->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role:</th>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $activity->user->role == 2 ? 'Super Admin' : 'User' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Joined:</th>
                                    <td>{{ $activity->user->created_at->format('M d, Y') }}</td>
                                </tr>
                            </table>
                            <div class="d-grid">
                                <a href="{{ route('customer.activities.show', $activity->user->id) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> View All User Activities
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Related Activities --}}
                @if ($relatedActivities->count() > 0)
                    <div class="card mt-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-link"></i> Related Activities
                                <small>(Same Session)</small>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($relatedActivities as $related)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $related->activity_name }}</div>
                                                <small class="text-muted">
                                                    {{ $related->created_at->format('H:i:s') }} -
                                                    {{ ucwords(str_replace('_', ' ', $related->activity_type)) }}
                                                </small>
                                            </div>
                                            <a href="{{ route('activities.show', $related->id) }}"
                                                class="btn btn-outline-primary btn-xs">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Quick Actions --}}
                <div class="card mt-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-tools"></i> Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            @if ($activity->user_id)
                                <a href="{{ route('activities.index', ['user_id' => $activity->user_id]) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-filter"></i> Filter by This User
                                </a>
                            @endif
                            <a href="{{ route('activities.index', ['activity_type' => $activity->activity_type]) }}"
                                class="btn btn-outline-info btn-sm">
                                <i class="fas fa-filter"></i> Filter by Activity Type
                            </a>
                            @if ($activity->ip_address)
                                <a href="{{ route('activities.index', ['search' => $activity->ip_address]) }}"
                                    class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-search"></i> Search by IP
                                </a>
                            @endif
                            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-print"></i> Print Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @media print {

                .btn,
                .card-header,
                nav {
                    display: none !important;
                }

                .card {
                    border: 1px solid #000 !important;
                }
            }

            .btn-xs {
                padding: 0.125rem 0.25rem;
                font-size: 0.75rem;
                line-height: 1.5;
                border-radius: 0.125rem;
            }

            code {
                font-size: 0.875rem;
            }

            pre code {
                font-size: 0.8rem;
            }
        </style>
    @endpush
</x-app-layout>
