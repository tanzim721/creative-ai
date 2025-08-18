<?php

namespace App\Http\Controllers;

use App\Models\Subuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SubuserController extends Controller
{
    /**
     * Display a listing of subusers.
     */
    public function index()
    {
        $subusers = Auth::user()->subusers()->paginate(10);
        
        return view('subusers.index', compact('subusers'));
    }

    /**
     * Show the form for creating a new subuser.
     */
    public function create()
    {
        return view('subusers.create');
    }

    /**
     * Store a newly created subuser in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subusers'],
            'mobile' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_active' => ['boolean'],
        ]);

        $subuser = Subuser::create([
            'parent_user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'position' => $request->position,
            'password' => Hash::make($request->password),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser created successfully!');
    }

    /**
     * Display the specified subuser.
     */
    public function show(Subuser $subuser)
    {
        $this->authorize('view', $subuser);
        
        return view('subusers.show', compact('subuser'));
    }

    /**
     * Show the form for editing the specified subuser.
     */
    public function edit(Subuser $subuser)
    {
        $this->authorize('update', $subuser);
        
        return view('subusers.edit', compact('subuser'));
    }

    /**
     * Update the specified subuser in storage.
     */
    public function update(Request $request, Subuser $subuser)
    {
        $this->authorize('update', $subuser);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subusers,email,' . $subuser->id],
            'mobile' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'is_active' => ['boolean'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'position' => $request->position,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $subuser->update($updateData);

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser updated successfully!');
    }

    /**
     * Remove the specified subuser from storage.
     */
    public function destroy(Subuser $subuser)
    {
        $this->authorize('delete', $subuser);
        
        $subuser->delete();

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser deleted successfully!');
    }

    /**
     * Toggle subuser active status.
     */
    public function toggleStatus(Subuser $subuser)
    {
        $this->authorize('update', $subuser);
        
        $subuser->update([
            'is_active' => !$subuser->is_active
        ]);

        $status = $subuser->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('subusers.index')
            ->with('success', "Subuser {$status} successfully!");
    }
}