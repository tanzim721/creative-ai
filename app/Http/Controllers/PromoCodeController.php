<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoCodeController extends Controller
{
    /**
     * Show the list of promo codes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = PromoCode::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status')) {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Sorting
        $query->latest('id');

        // Pagination
        $promoCodes = $query->paginate(10);

        return view('super_admin.promoCode.index', compact('promoCodes'));
    }

    /**
     * Show the form for creating a new promo code.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promoCode = new PromoCode(); // Empty model for create
        $isEdit = false;
        return view('super_admin.promoCode.create', compact('promoCode', 'isEdit'));
    }

    /**
     * Store a newly created promo code in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code',
            'type' => 'required|in:percentage,fixed,free',
            'value' => 'required|numeric|min:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'usage_limit' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);


        // Ensure the plan_id is valid
        // Set is_active to false if not provided
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        // If this is active, make all others inactive
        if ($request->has('is_active') && $request->is_active) {
            DB::transaction(function () use ($validated) {
                // PromoCode::where('is_active', true)->update(['is_active' => false]);
                PromoCode::create($validated);
            });
        } else {
            PromoCode::create($validated);
        }

        // Clear config cache to apply changes immediately
        if ($validated['is_active']) {
            // This will make the config change apply for the current request
            config(['auth.defaults.admin_code' => $validated['code']]);
        }

        return redirect()->route('promocodes.index')
            ->with('success', 'Promo code created successfully.');
    }

    public function edit(Request $request, PromoCode $promocode)
    {
        $promoCode = $promocode; // Fetch the promo code by ID
        $isEdit = true;
        return view('super_admin.promoCode.create', compact('promoCode', 'isEdit'));
    }

    public function update(Request $request, PromoCode $promocode)
    {
        $validated = $request->validate([
            'type' => 'required|in:percentage,fixed,free',
            'value' => 'required|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'code' => 'required|string|max:255|unique:promo_codes,code,' . $promocode->id,
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'is_active' => 'boolean',
        ]);

        // dd($validated);
        // Ensure is_active is set to false if not provided
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        // If this is active, make all others inactive
        if ($request->has('is_active') && $request->is_active) {
            DB::transaction(function () use ($promocode, $validated) {
                PromoCode::where('id', '!=', $promocode->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
                $promocode->update($validated);
            });
        } else {
            $promocode->update($validated);
        }

        // If this is active, update config for current request
        if ($validated['is_active']) {
            config(['auth.defaults.admin_code' => $validated['code']]);
        }

        // If this is active, make all others inactive
        // if ($request->has('is_active') && $request->is_active) {
        //     DB::transaction(function () use ($promocode, $validated) {
        //         PromoCode::where('id', '!=', $promocode->id)
        //             ->where('is_active', true)
        //             ->update(['is_active' => false]);
        //         $promocode->update($validated);
        //     });
        // } else {
        //     $promocode->update($validated);
        // }

        return redirect()->route('promocodes.index')
            ->with('success', 'Promo code updated successfully.');
    }

    public function destroy(PromoCode $promocode)
    {
        try {
            $promocode->delete();
            return redirect()->route('promocodes.index')
                ->with('success', 'Promo code deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('promocodes.index')
                ->with('error', 'Failed to delete promo code: ' . $e->getMessage());
        }
    }

    public function toggleActive(PromoCode $promoCode)
    {
        DB::transaction(function () use ($promoCode) {
            // If activating, deactivate all others
            if (!$promoCode->is_active) {
                // PromoCode::where('is_active', true)->update(['is_active' => false]);
                $promoCode->is_active = true;
            } else {
                $promoCode->is_active = false;
            }
            $promoCode->save();
        });

        return back()->with('success', 'Promo code status updated successfully.');
    }
}
