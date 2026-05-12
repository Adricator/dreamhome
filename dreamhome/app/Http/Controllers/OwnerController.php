<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search input
        $query = $request->input('search');

        // Fetch owners with optional search
        $owners = Owner::when($query, function ($q) use ($query) {
            return $q->where('first_name', 'like', "%{$query}%")
                     ->orWhere('last_name', 'like', "%{$query}%");
        })->get();

        // Return view
        return view('owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|unique:owners',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'telephone_no' => 'required',
            'email' => 'required|email',
        ]);

        Owner::create($validated);

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        return view('owners.show', compact('owner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'telephone_no' => 'required',
            'email' => 'required|email',
        ]);

        $owner->update($validated);

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner deleted successfully.');
    }
}