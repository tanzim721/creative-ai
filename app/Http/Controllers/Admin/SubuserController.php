<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subuser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SubuserController extends Controller
{
    /**
     * Display a listing of the subusers.
     */
    public function index()
    {
        $subusers = auth()->user()->subusers;
        return view('creatives_test.users.index', compact('subusers'));
    }

    /**
     * Show the form for creating a new subuser.
     */
    public function create()
    {
        return view('creatives_test.users.create');
    }

    /**
     * Store a newly created subuser in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:subusers',
            'mobile' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $subuser = new Subuser([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        auth()->user()->subusers()->save($subuser);

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser created successfully.');
    }

    /**
     * Display the specified subuser.
     */
    public function show(Subuser $subuser)
    {
        $this->checkOwnership($subuser);
        return view('subusers.show', compact('subuser'));
    }

    /**
     * Show the form for editing the specified subuser.
     */
    public function edit(Subuser $subuser)
    {
        $this->checkOwnership($subuser);
        return view('creatives_test.users.edit', compact('subuser'));
    }

    /**
     * Update the specified subuser in storage.
     */
    public function update(Request $request, Subuser $subuser)
    {
        $this->checkOwnership($subuser);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('subusers')->ignore($subuser->id),
            ],
            'mobile' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'position' => $request->position,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $subuser->update($data);

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser updated successfully.');
    }

    /**
     * Toggle the active status of the specified subuser.
     */
    public function toggleStatus(Subuser $subuser)
    {
        $this->checkOwnership($subuser);
        $subuser->update(['is_active' => !$subuser->is_active]);

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser status updated successfully.');
    }

    /**
     * Remove the specified subuser from storage.
     */
    public function destroy(Subuser $subuser)
    {
        $this->checkOwnership($subuser);
        $subuser->delete();

        return redirect()->route('subusers.index')
            ->with('success', 'Subuser deleted successfully.');
    }

    /**
     * Check if the authenticated user owns this subuser.
     *
     * @param  \App\Models\Subuser  $subuser
     * @return void
     */
    private function checkOwnership(Subuser $subuser)
    {
        if ($subuser->parent_user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
