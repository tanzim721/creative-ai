<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\UserActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['user_id', 'activity_type', 'date_from', 'date_to', 'search']);
        
        $activities = UserActivity::query()
            ->with(['user'])
            ->when($filters['user_id'] ?? null, function ($query, $userId) {
                $query->where('user_id', $userId);
            })
            ->when($filters['activity_type'] ?? null, function ($query, $type) {
                $query->where('activity_type', $type);
            })
            ->when($filters['date_from'] ?? null, function ($query, $date) {
                $query->whereDate('created_at', '>=', $date);
            })
            ->when($filters['date_to'] ?? null, function ($query, $date) {
                $query->whereDate('created_at', '<=', $date);
            })
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('activity_name', 'LIKE', "%{$search}%")
                      ->orWhere('url', 'LIKE', "%{$search}%")
                      ->orWhereHas('user', function ($userQuery) use ($search) {
                          $userQuery->where('name', 'LIKE', "%{$search}%")
                                   ->orWhere('email', 'LIKE', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(50);

        $stats = $this->getActivityStats();
        $users = User::select('id', 'name', 'email')->get();
        $activityTypes = UserActivity::distinct('activity_type')->pluck('activity_type');

        return view('super_admin.activities.index', compact('activities', 'stats', 'users', 'activityTypes', 'filters'));
    }

    public function show($id)
    {
        $activity = UserActivity::with(['user'])->findOrFail($id);
        
        // Get related activities (same session or user)
        $relatedActivities = UserActivity::where('user_id', $activity->user_id)
            ->where('session_id', $activity->session_id)
            ->where('id', '!=', $activity->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('super_admin.activities.show', compact('activity', 'relatedActivities'));
    }

    public function analytics(Request $request)
    {
        $period = $request->get('period', '7days');
        
        $dateRange = $this->getDateRange($period);
        
        $data = [
            'daily_activities' => $this->getDailyActivities($dateRange),
            'activity_breakdown' => $this->getActivityBreakdown($dateRange),
            'top_users' => $this->getTopActiveUsers($dateRange),
            'browser_stats' => $this->getBrowserStats($dateRange),
            'page_views' => $this->getPopularPages($dateRange),
        ];

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('super_admin.activities.analytics', compact('data', 'period'));
    }

    public function export(Request $request)
    {
        $filters = $request->only(['user_id', 'activity_type', 'date_from', 'date_to']);
        
        $activities = UserActivity::with(['user'])
            ->when($filters['user_id'] ?? null, function ($query, $userId) {
                $query->where('user_id', $userId);
            })
            ->when($filters['activity_type'] ?? null, function ($query, $type) {
                $query->where('activity_type', $type);
            })
            ->when($filters['date_from'] ?? null, function ($query, $date) {
                $query->whereDate('created_at', '>=', $date);
            })
            ->when($filters['date_to'] ?? null, function ($query, $date) {
                $query->whereDate('created_at', '<=', $date);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = 'user_activities_' . now()->format('Y_m_d_H_i_s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        return response()->stream(function () use ($activities) {
            $handle = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($handle, [
                'ID', 'User', 'Email', 'Activity Type', 'Activity Name', 
                'URL', 'Method', 'IP Address', 'Browser', 'Date/Time'
            ]);
            
            foreach ($activities as $activity) {
                fputcsv($handle, [
                    $activity->id,
                    $activity->user_name,
                    $activity->user ? $activity->user->email : '',
                    $activity->activity_type,
                    $activity->activity_name,
                    $activity->url,
                    $activity->method,
                    $activity->ip_address,
                    $activity->browser,
                    $activity->formatted_created_at,
                ]);
            }
            
            fclose($handle);
        }, 200, $headers);
    }

    private function getActivityStats()
    {
        return [
            'total_activities' => UserActivity::count(),
            'today_activities' => UserActivity::today()->count(),
            'week_activities' => UserActivity::thisWeek()->count(),
            'month_activities' => UserActivity::thisMonth()->count(),
            'unique_users_today' => UserActivity::today()->distinct('user_id')->count('user_id'),
            'most_active_user' => UserActivity::select('user_id')
                ->with('user:id,name')
                ->groupBy('user_id')
                ->orderByRaw('COUNT(*) DESC')
                ->first(),
        ];
    }

    private function getDateRange($period)
    {
        return match ($period) {
            '24hours' => [now()->subDay(), now()],
            '7days' => [now()->subWeek(), now()],
            '30days' => [now()->subMonth(), now()],
            '90days' => [now()->subDays(90), now()],
            default => [now()->subWeek(), now()],
        };
    }

    private function getDailyActivities($dateRange)
    {
        return UserActivity::whereBetween('created_at', $dateRange)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getActivityBreakdown($dateRange)
    {
        return UserActivity::whereBetween('created_at', $dateRange)
            ->select('activity_type', DB::raw('COUNT(*) as count'))
            ->groupBy('activity_type')
            ->orderBy('count', 'desc')
            ->get();
    }

    private function getTopActiveUsers($dateRange)
    {
        return UserActivity::whereBetween('created_at', $dateRange)
            ->select('user_id', DB::raw('COUNT(*) as activity_count'))
            ->with('user:id,name,email')
            ->groupBy('user_id')
            ->orderBy('activity_count', 'desc')
            ->limit(10)
            ->get();
    }

    private function getBrowserStats($dateRange)
    {
        return UserActivity::whereBetween('created_at', $dateRange)
            ->whereNotNull('user_agent')
            ->get()
            ->groupBy('browser')
            ->map(function ($group) {
                return $group->count();
            })
            ->sortDesc();
    }

    private function getPopularPages($dateRange)
    {
        return UserActivity::whereBetween('created_at', $dateRange)
            ->where('activity_type', 'page_view')
            ->select('activity_name', DB::raw('COUNT(*) as views'))
            ->groupBy('activity_name')
            ->orderBy('views', 'desc')
            ->limit(10)
            ->get();
    }
}