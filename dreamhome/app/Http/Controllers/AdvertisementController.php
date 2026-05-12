<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load the property relationship to show property details in the view
        $advertisements = Advertisement::with('property')->get();
        return view('advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new advertisement.
     */
    public function create()
    {
        // We need the list of properties to populate a dropdown in the form
        $properties = Property::all();
        return view('advertisements.create', compact('properties'));
    }

    /**
     * Store a newly created advertisement in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ad_id' => 'required|string|max:20|unique:advertisements,ad_id',
            'property_id' => 'required|exists:properties,property_id', // Ensures the property exists
            'media_source' => 'required|string|max:50', // Corrected to string
            'date_advertised' => 'required|date',       // Corrected to date
            'cost' => 'required|numeric|min:0',
        ]);

        Advertisement::create($validated);

        return redirect()->route('advertisements.index')
                         ->with('success', 'Advertisement created successfully.');
    }

    /**
     * Show the form for editing the specified advertisement.
     */
    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $properties = Property::all();
        return view('advertisements.edit', compact('advertisement', 'properties'));
    }

    /**
     * Update the specified advertisement in storage.
     */
    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $validated = $request->validate([
            'property_id' => 'required|exists:properties,property_id',
            'media_source' => 'required|string|max:50',
            'date_advertised' => 'required|date',
            'cost' => 'required|numeric|min:0',
        ]);

        $advertisement->update($validated);

        return redirect()->route('advertisements.index')
                         ->with('success', 'Advertisement updated successfully.');
    }
}
