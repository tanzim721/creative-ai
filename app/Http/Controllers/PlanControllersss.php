<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\PlanRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the plans.
     */
    public function index()
    {
        // $plans = Plan::latest()->paginate(10);
        $plans = Plan::query()
            ->when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->when(request('status'), function ($query) {
                $status = request('status');
                if ($status === 'active') {
                    $query->where('is_active', true);
                } elseif ($status === 'inactive') {
                    $query->where('is_active', false);
                }
            })
            ->latest('id')
            ->paginate(10);
        return view('super_admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     */
    public function create()
    {
        return view('super_admin.plans.create');
    }

    /**
     * Store a newly created plan in storage.
     */
    public function store(PlanRequest $request)
    {

        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }


        // Handle boolean fields that might not be present in the request
        $booleanFields = [
            'is_active',
            'is_custom',
        ];

        foreach ($booleanFields as $field) {
            $validated[$field] = isset($validated[$field]) ? true : false;
        }

        // Ensure price and download limit fields are properly set
        $validated['monthly_price'] = $validated['monthly_price'] ?? 0;
        $validated['yearly_price'] = $validated['yearly_price'] ?? 0;
        $validated['monthly_download_limit'] = $validated['monthly_download_limit'] ?? 0;
        $validated['yearly_download_limit'] = $validated['yearly_download_limit'] ?? 0;

        // Create the plan
        Plan::create($validated);

        return redirect()->route('plans.index')
            ->with('success', 'Plan created successfully!');
    }

    /**
     * Display the specified plan.
     */
    public function show(Plan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     */
    public function edit(Plan $plan)
    {
        return view('super_admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $validated = $request->validated();

        // Ensure features is JSON serializable
        if (isset($validated['features']) && is_array($validated['features'])) {
            $validated['features'] = $validated['features'];
        }

        // Handle checkboxes that might not be in the request
        $checkboxFields = [
            'is_active',
            'has_video_generation',
            'has_ai_options',
            'has_priority_support',
            'has_custom_dimensions',
            'has_analytics'
        ];

        foreach ($checkboxFields as $field) {
            $validated[$field] = isset($validated[$field]) ? true : false;
        }

        $plan->update($validated);

        return redirect()->route('plans.index')
            ->with('success', 'Plan updated successfully!');
    }

    /**
     * Remove the specified plan from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')
            ->with('success', 'Plan deleted successfully!');
    }

    /**
     * Toggle plan active status.
     */
    
}
