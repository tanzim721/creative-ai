<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Download;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DownloadController extends Controller
{
    /**
     * Display the download history for all users.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function downloadHistory(Request $request)
    {
        $query = Download::with('user', 'subscription');

        // Add search filters here if needed
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sorting
        $query->latest('id');

        // Pagination
        $downloads = $query->paginate(10);
        return view('super_admin.downloads.index', compact('downloads'));
    }
}
