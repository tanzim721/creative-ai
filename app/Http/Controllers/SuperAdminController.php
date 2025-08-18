<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Creative;
use App\Models\Download;
use Illuminate\View\View;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\PaymentLog;

class SuperAdminController extends Controller
{
    protected $middleware = ['auth'];

    public function index(Request $request)
    {
        // Start with base query - exclude current authenticated user
        $query = User::query()->where('id', '!=', auth()->id());

        // Debug - log incoming request parameters
        \Log::info('Filter parameters:', $request->all());

        // Apply company name filter if provided
        if ($request->filled('company_name')) {
            $query->where('company_name', 'LIKE', '%' . $request->company_name . '%');
        }

        // Apply contact name filter if provided
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Apply email filter if provided
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if ($request->filled('status')) {
            $query->where('role', $request->status);
            \Log::info('Status filter applied:', ['status' => $request->status]);
        }

        // Get results with pagination and maintain query parameters in pagination links
        $users = $query->orderByDesc('id')->paginate(10)->withQueryString();

        // For debugging - log the final SQL query
        \Log::info('Generated SQL query: ' . $query->toSql(), $query->getBindings());

        return view('super_admin.dashboard', compact('users'));
    }


    /**
     * Update the specified user's role.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);
        $user = User::findOrFail($id);
        $user->role = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => (int) $user->role,
            'statusText' => $user->role == 1 ? 'Active' : 'Inactive'
        ]);
    }

    public function allCreatives()
    {
        $creatives = Creative::with(['creative_type', 'user'])->orderByDesc('id')->paginate(10);
        return view('super_admin.allCreatives', compact('creatives'));
    }

    public function show($id)
    {
        $creative = Creative::with('creative_type')->find($id);
        // dd($creative->creative_type_id);
        // $creative = CreativeType::with('creatives')->find($id);
        // dd($creative->creative_type->id);
        if ($creative->creative_type_id == 1) {
            // dd($creative);
            return view('creatives.carousel', compact('creative'));
        } elseif ($creative->creative_type_id == 2) {
            // dd($creative);
            return view('creatives.scratch', compact('creative'));
        } elseif ($creative->creative_type_id == 3) {
            // dd($creative);
            return view('creatives.videoCanvas', compact('creative'));
        } elseif ($creative->creative_type_id == 4) {
            // dd($creative);
            return view('creatives.videoWithImageCarousel', compact('creative'));
        } elseif ($creative->creative_type_id == 5) {
            // dd($creative);
            return view('creatives.videoWithImageSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 6) {
            // dd($creative);
            return view('creatives.interactiveImageSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 7) {
            // dd($creative);
            return view('creatives.imageHoverAnimation', compact('creative'));
        } elseif ($creative->creative_type_id == 8) {
            return view('creatives.cricketGamification', compact('creative'));
        } elseif ($creative->creative_type_id == 9) {
            return view('creatives.footballGamification', compact('creative'));
        } elseif ($creative->creative_type_id == 10) {
            return view('creatives.scratchToReveal', compact('creative'));
        } elseif ($creative->creative_type_id == 11) {
            return view('creatives.3DRotatingCube', compact('creative'));
        } elseif ($creative->creative_type_id == 12) {
            return view('creatives.NewExpandableImage', compact('creative'));
        } elseif ($creative->creative_type_id == 13) {
            return view('creatives.countDown', compact('creative'));
        } elseif ($creative->creative_type_id == 14) {
            return view('creatives.scratchToRevealVideo', compact('creative'));
        } elseif ($creative->creative_type_id == 15) {
            return view('creatives.videoImageExpandOnHover', compact('creative'));
        } elseif ($creative->creative_type_id == 16) {
            return view('creatives.productSlider', compact('creative'));
        } elseif ($creative->creative_type_id == 17) {
            return view('creatives.locationBasedAds', compact('creative'));
        } elseif ($creative->creative_type_id == 18) {
            return view('creatives.responsive3DRotatingCube', compact('creative'));
        } elseif ($creative->creative_type_id == 19) {
            return view('creatives.storiesAds', compact('creative'));
        } elseif ($creative->creative_type_id == 20) {
            return view('creatives.creativeSwiper', compact('creative'));
        } elseif ($creative->creative_type_id == 21) {
            return view('creatives.creativeImageAnimation', compact('creative'));
        }
    }

    public function cutomerActivities(Request $request)
    {
        // Start with base query - exclude current authenticated user
        $query = User::query()->where('id', '!=', auth()->id());

        // Debug - log incoming request parameters
        \Log::info('Filter parameters:', $request->all());


        // Apply contact name filter if provided
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Apply email filter if provided
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        // Get results with pagination and maintain query parameters in pagination links
        $users = $query->orderByDesc('id')->paginate(10)->withQueryString();

        // For debugging - log the final SQL query
        \Log::info('Generated SQL query: ' . $query->toSql(), $query->getBindings());

        return view('super_admin.customers.index', compact('users'));
    }
    public function customerDetails(Request $request)
    {
        // $userId = $request->id; // Assuming you're passing a user ID in the request

        // $user = User::with([
        //     'subscriptions' => function($query) {
        //         $query->orderBy('created_at', 'desc');
        //     },
        //     'downloads' => function($query) {
        //         $query->orderBy('created_at', 'desc');
        //     },
        //     'creatives' => function($query) {
        //         $query->orderBy('created_at', 'desc');
        //     }
        // ])->findOrFail($userId);

        // // Summary statistics
        // $totalDownloads = $user->downloads->sum('download_count');
        // $activeSubscription = $user->subscriptions->where('status', 'active')->first();
        // $subscriptionHistory = $user->subscriptions;

        // $downloadCount = Download::with('user', 'subscription', 'subscription.plan')
        //     ->where('user_id', $userId)
        //     ->when($request->has('search'), function ($query) use ($request) {
        //         $search = $request->input('search');
        //         $query->whereHas('user', function ($q) use ($search) {
        //             $q->where('name', 'like', "%{$search}%")
        //               ->orWhere('email', 'like', "%{$search}%");
        //         });
        //     })
        //     ->latest('id')
        //     ->paginate(10);
        // dd($downloadCount);

        // return view('super_admin.customers.details', compact(
        //     'user',
        //     'totalDownloads',
        //     'activeSubscription',
        //     'subscriptionHistory',
        //     'downloadCount'
        // ));


        $userId = $request->id;
    
        $user = User::with([
            'downloads' => function($query) {
                $query->with('subscription.plan')->orderBy('created_at', 'desc');
            },
            'subscriptions' => function($query) {
                $query->with('plan')->orderBy('created_at', 'desc');
            },
            'creatives' => function($query) {
                $query->orderBy('created_at', 'desc')->paginate(10);
            }
        ])->findOrFail($userId);
        // dd($user);
        
        $totalDownloads = $user->downloads->sum('download_count');
        $activeSubscription = $user->subscriptions->where('status', 'active')->first();
        
        return view('super_admin.customers.details', compact(
            'user', 
            'totalDownloads',
            'activeSubscription',
        ));
            
    }

    public function paymentLogs(Request $request)
    {
        $query = PaymentLog::with(['user', 'plan']);
        
        // Search by user name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $paymentLogs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Calculate statistics
        $totalLogs = PaymentLog::count();
        $totalRevenue = PaymentLog::where('status', 'success')->sum('amount') ?? 0;
        $pendingAmount = PaymentLog::where('status', 'pending')->sum('amount') ?? 0;
        $successfulTransactions = PaymentLog::where('status', 'success')->count();
        
        return view('super_admin.paymentLogs', compact(
            'paymentLogs', 
            'totalLogs', 
            'totalRevenue', 
            'pendingAmount', 
            'successfulTransactions'
        ));
    }
    
}
