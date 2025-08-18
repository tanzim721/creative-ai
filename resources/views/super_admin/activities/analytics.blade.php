<x-app-layout>


    <div class="container-fluid">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Activity Analytics</h1>
            <div class="d-flex gap-2">
                <select id="periodSelector" class="form-select" style="width: auto;">
                    <option value="24hours" {{ $period === '24hours' ? 'selected' : '' }}>Last 24 Hours</option>
                    <option value="7days" {{ $period === '7days' ? 'selected' : '' }}>Last 7 Days</option>
                    <option value="30days" {{ $period === '30days' ? 'selected' : '' }}>Last 30 Days</option>
                    <option value="90days" {{ $period === '90days' ? 'selected' : '' }}>Last 90 Days</option>
                </select>
                <a href="{{ route('activities.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> View All Activities
                </a>
            </div>
        </div>

        {{-- Daily Activity Chart --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-line"></i> Daily Activity Trends
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyActivityChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            {{-- Activity Breakdown --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-pie-chart"></i> Activity Types
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="activityBreakdownChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Browser Stats --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-desktop"></i> Browser Usage
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="browserStatsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            {{-- Top Active Users --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-users"></i> Most Active Users
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Activities</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="topUsersTable">
                                    <!-- Will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Popular Pages --}}
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-eye"></i> Most Viewed Pages
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody id="popularPagesTable">
                                    <!-- Will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Real-time Activity Feed --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-stream"></i> Live Activity Feed
                            <span class="badge bg-success" id="liveIndicator">LIVE</span>
                        </h5>
                        <button id="toggleLive" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-pause"></i> Pause
                        </button>
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        <div id="liveActivityFeed">
                            <!-- Live activities will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loadingSpinner" class="position-fixed top-50 start-50 translate-middle"
        style="z-index: 9999; display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @push('styles')
        <style>
            .live-activity-item {
                border-left: 4px solid #007bff;
                background: #f8f9fa;
                margin-bottom: 0.5rem;
                transition: all 0.3s ease;
            }

            .live-activity-item.new {
                animation: fadeInSlide 0.5s ease-out;
                border-left-color: #28a745;
                background: #d4edda;
            }

            @keyframes fadeInSlide {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .activity-badge {
                font-size: 0.7rem;
            }

            #liveIndicator {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.5;
                }

                100% {
                    opacity: 1;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let chartInstances = {};
                let liveUpdateInterval;
                let isLiveActive = true;

                // Initialize charts with initial data
                const initialData = @json($data);
                initializeCharts(initialData);
                updateTables(initialData);

                // Period selector change handler
                document.getElementById('periodSelector').addEventListener('change', function() {
                    const period = this.value;
                    window.location.href = `{{ route('activities.analytics') }}?period=${period}`;
                });

                // Live feed toggle
                document.getElementById('toggleLive').addEventListener('click', function() {
                    if (isLiveActive) {
                        clearInterval(liveUpdateInterval);
                        this.innerHTML = '<i class="fas fa-play"></i> Resume';
                        document.getElementById('liveIndicator').textContent = 'PAUSED';
                        document.getElementById('liveIndicator').className = 'badge bg-warning';
                        isLiveActive = false;
                    } else {
                        startLiveUpdates();
                        this.innerHTML = '<i class="fas fa-pause"></i> Pause';
                        document.getElementById('liveIndicator').textContent = 'LIVE';
                        document.getElementById('liveIndicator').className = 'badge bg-success';
                        isLiveActive = true;
                    }
                });

                function initializeCharts(data) {
                    // Daily Activity Chart
                    const dailyCtx = document.getElementById('dailyActivityChart').getContext('2d');
                    chartInstances.daily = new Chart(dailyCtx, {
                        type: 'line',
                        data: {
                            labels: data.daily_activities.map(item => new Date(item.date).toLocaleDateString()),
                            datasets: [{
                                label: 'Activities',
                                data: data.daily_activities.map(item => item.count),
                                borderColor: 'rgb(75, 192, 192)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                tension: 0.1,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Activity Breakdown Pie Chart
                    const breakdownCtx = document.getElementById('activityBreakdownChart').getContext('2d');
                    chartInstances.breakdown = new Chart(breakdownCtx, {
                        type: 'doughnut',
                        data: {
                            labels: data.activity_breakdown.map(item => item.activity_type.replace('_', ' ')
                                .toUpperCase()),
                            datasets: [{
                                data: data.activity_breakdown.map(item => item.count),
                                backgroundColor: [
                                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom'
                                }
                            }
                        }
                    });

                    // Browser Stats Chart
                    const browserCtx = document.getElementById('browserStatsChart').getContext('2d');
                    const browserLabels = Object.keys(data.browser_stats);
                    const browserData = Object.values(data.browser_stats);

                    chartInstances.browser = new Chart(browserCtx, {
                        type: 'bar',
                        data: {
                            labels: browserLabels,
                            datasets: [{
                                label: 'Users',
                                data: browserData,
                                backgroundColor: '#36A2EB'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                function updateTables(data) {
                    // Update top users table
                    const topUsersTable = document.getElementById('topUsersTable');
                    topUsersTable.innerHTML = data.top_users.map(user => `
            <tr>
                <td>
                    <strong>${user.user ? user.user.name : 'Unknown'}</strong>
                    ${user.user ? `<br><small class="text-muted">${user.user.email}</small>` : ''}
                </td>
                <td><span class="badge bg-primary">${user.activity_count}</span></td>
                <td>
                    <a href="/admin/customer/activities/show/${user.user_id}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        `).join('');

                    // Update popular pages table
                    const popularPagesTable = document.getElementById('popularPagesTable');
                    popularPagesTable.innerHTML = data.page_views.map(page => `
            <tr>
                <td>${page.activity_name}</td>
                <td><span class="badge bg-info">${page.views}</span></td>
            </tr>
        `).join('');
                }

                function startLiveUpdates() {
                    // Load initial live feed
                    loadLiveActivities();

                    // Update every 5 seconds
                    liveUpdateInterval = setInterval(loadLiveActivities, 5000);
                }

                function loadLiveActivities() {
                    fetch('/admin/activities/live-feed')
                        .then(response => response.json())
                        .then(activities => {
                            const feedContainer = document.getElementById('liveActivityFeed');

                            activities.forEach(activity => {
                                const activityElement = createActivityElement(activity);
                                feedContainer.insertBefore(activityElement, feedContainer.firstChild);
                            });

                            // Keep only last 20 activities
                            while (feedContainer.children.length > 20) {
                                feedContainer.removeChild(feedContainer.lastChild);
                            }
                        })
                        .catch(error => console.error('Error loading live activities:', error));
                }

                function createActivityElement(activity) {
                    const div = document.createElement('div');
                    div.className = 'live-activity-item new p-3 rounded';
                    div.innerHTML = `
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>${activity.user_name}</strong>
                    <span class="activity-badge badge bg-${getActivityBadgeColor(activity.activity_type)} ms-2">
                        ${activity.activity_type.replace('_', ' ').toUpperCase()}
                    </span>
                    <div class="mt-1">
                        <small class="text-muted">${activity.activity_name}</small>
                    </div>
                </div>
                <small class="text-muted">${formatTimeAgo(activity.created_at)}</small>
            </div>
        `;

                    // Remove 'new' class after animation
                    setTimeout(() => {
                        div.classList.remove('new');
                    }, 500);

                    return div;
                }

                function getActivityBadgeColor(type) {
                    const colors = {
                        'page_view': 'primary',
                        'form_submission': 'success',
                        'button_click': 'warning',
                        'creative_generation': 'info',
                        'download': 'secondary'
                    };
                    return colors[type] || 'secondary';
                }

                function formatTimeAgo(timestamp) {
                    const now = new Date();
                    const time = new Date(timestamp);
                    const diff = Math.floor((now - time) / 1000);

                    if (diff < 60) return 'just now';
                    if (diff < 3600) return Math.floor(diff / 60) + 'm ago';
                    if (diff < 86400) return Math.floor(diff / 3600) + 'h ago';
                    return Math.floor(diff / 86400) + 'd ago';
                }

                // Start live updates
                startLiveUpdates();
            });
        </script>
    @endpush

</x-app-layout>
