<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Owner;
use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Start a query builder instance
        $query = Property::query();

        // 1. Handle Searching (only if 'search' has a value)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('street', 'ILIKE', "%{$search}%")
                  ->orWhere('city', 'ILIKE', "%{$search}%")
                  ->orWhere('area', 'ILIKE', "%{$search}%")
                  ->orWhere('postcode', 'ILIKE', "%{$search}%")
                  ->orWhere('property_id', 'ILIKE', "%{$search}%");
            });
        }

        // 2. Handle Status Filtering
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // 3. Handle Type Filtering
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Get results with pagination (10 per page)
        // withQueryString ensures filters stay active when clicking page 2, 3, etc.
        $properties = $query->get();

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        $owners = Owner::all();
        $branches = Branch::all();
        return view('properties.create', compact('owners', 'branches'));
    }

    public function store(StorePropertyRequest $request)
    {
        // This uses the rules defined in your StorePropertyRequest file
        Property::create($request->validated());

        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    public function edit($property_id)
    {
        $property = Property::where('property_id', $property_id)->firstOrFail();
        $owners = Owner::all();
        $branches = Branch::all();

        return view('properties.edit', compact('property', 'owners', 'branches'));
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        // Update only the fields that passed validation
        $property->update($request->validated());

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    public function show($id)
    {
        $property = Property::with('advertisements')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->with('success', 'Property deleted.');
    }
}