<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Download;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function allUsers(Request $request)
    {
        // Fetch all users with the same company name as the authenticated user
        $users = User::where('company_name', auth()->user()->company_name)->paginate(8);
        return view('creatives_test.users.index', compact('users'));
    }	

    public function Status(Request $request, $id)
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

    public function userDownloadCount(Request $request)
    {
        $user = User::where('company_name', auth()->user()->company_name)->first();
        if ($user) {
            $downloadCount = $user->downloads()->count();
            return response()->json(['download_count' => $downloadCount]);
        }
        return response()->json(['download_count' => 0]);
    }
    public function downloadHistory(Request $request)
    {
        // $downloadCount = Download::where('user_id', Auth::id())->get();
        $downloadCount = Download::with('user', 'subscription', 'subscription.plan')
            ->where('user_id', Auth::id())
            ->when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(10);
            // dd($downloadCount);
        
        return view('creatives_test.downloads.index', compact('downloadCount'));
    }

    public function trackDownload(Request $request)
    {
        // Validate the request
        $request->validate([
            'creative_id' => 'required|integer',
            'content_type' => 'required|string',
        ]);

        $user = Auth::user();
        
        // Get the user's active subscription
        $subscription = $user->subscriptions()
                            ->where('status', 'active')
                            ->where('expires_at', '>', now())
                            ->first();
        
        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'No active subscription found'
            ], 403);
        }
        
        // Check if there's an existing download record
        $download = Download::where('user_id', $user->id)
                        ->where('subscription_id', $subscription->id)
                        ->where('content_type', $request->content_type)
                        ->first();
        
        if ($download) {
            // Increment the download count
            $download->download_count += 1;
            $download->save();
        } else {
            // Create a new download record
            $download = new Download();
            $download->user_id = $user->id;
            $download->subscription_id = $subscription->id;
            $download->content_type = $request->content_type;
            $download->download_count = 1;
            $download->save();
        }
        
        // Also increment the downloads_used count on the subscription
        $subscription->downloads_used += 1;
        $subscription->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Download tracked successfully',
            'download_count' => $download->download_count
        ]);
    }

    
}
