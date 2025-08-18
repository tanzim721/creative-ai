<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $query = Plan::query();

        // Add search filters here if needed
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Sorting
        $query->latest('id');

        // Pagination
        $plans = $query->paginate(10);
        return view('super_admin.plans.index', compact('plans'));
    }
    
    public function create()
    {
        $plan = new Plan(); // Empty model for create
        $isEdit = false;
        return view('super_admin.plans.create', compact('plan', 'isEdit'));
    }
    
    public function store(Request $request, Plan $plan)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:plans,name',
            'description' => 'nullable|string',
            'stripe_price_id' => 'required|string|max:255|unique:plans,stripe_price_id',	
            'monthly_price' => 'required|numeric|min:0',
            'yearly_price' => 'required|numeric|min:0',
            'monthly_download_limit' => 'required|integer|min:0',
            'yearly_download_limit' => 'required|integer|min:0',
            'is_custom' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $plan->create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'stripe_price_id' => $request->stripe_price_id,
            'monthly_price' => $request->monthly_price,
            'yearly_price' => $request->yearly_price,
            'monthly_download_limit' => $request->monthly_download_limit,
            'yearly_download_limit' => $request->yearly_download_limit,
            'is_custom' => $request->is_custom ?? false,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Plan created successfully');
    }
    
    public function edit(Plan $plan)
    {
        $isEdit = true;
        return view('super_admin.plans.create', compact('plan', 'isEdit'));
    }
    
    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plans,name,' . $plan->id,
            'stripe_price_id' => 'required|string|max:255|unique:plans,stripe_price_id,' . $plan->id,
            'description' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
            'yearly_price' => 'required|numeric|min:0',
            'monthly_download_limit' => 'required|integer|min:0',
            'yearly_download_limit' => 'required|integer|min:0',
            'is_custom' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Generate slug from name
        $slug = Str::slug($request->name);

        $plan->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'stripe_price_id' => $request->stripe_price_id,
            'monthly_price' => $request->monthly_price,
            'yearly_price' => $request->yearly_price,
            'monthly_download_limit' => $request->monthly_download_limit,
            'yearly_download_limit' => $request->yearly_download_limit,
            'is_custom' => $request->is_custom ?? false,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Plan updated successfully');
    }
    
    public function destroy(Plan $plan)
    {
        // Check if plan has subscriptions
        if ($plan->subscriptions()->count() > 0) {
            return back()->withErrors(['delete' => 'Cannot delete plan with active subscriptions']);
        }
        
        $plan->delete();
        
        return redirect()->route('plans.index')
            ->with('success', 'Plan deleted successfully');
    }

    public function toggleActive(Plan $plan)
    {
        $plan->update([
            'is_active' => !$plan->is_active
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Plan status updated successfully!');
    }
}