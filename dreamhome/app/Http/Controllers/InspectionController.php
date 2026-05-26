<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Property;
use App\Models\Staff;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $inspections = Inspection::when($search, function ($query, $search) {
            $query->where('property_id', 'ILIKE', "%{$search}%")
                  ->orWhere('staff_id', 'ILIKE', "%{$search}%")
                  ->orWhere('comment', 'ILIKE', "%{$search}%");
        })
        ->orderBy('inspection_id', 'desc')
        ->get();

        return view('inspections.index', compact('inspections'));
    }

     public function create()
    {
        $properties = Property::all(); 
         $staffs = Staff::all();     

    return view('inspections.create', compact('properties', 'staffs'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|string|max:255',
            'staff_id' => 'required|string|max:255',
            'inspection_date' => 'required|date',
            'comments' => 'nullable|string',
        ]);

        Inspection::create($validated);

        return redirect()
            ->route('inspections.index')
            ->with('success', 'Inspection created successfully.');
    }

    public function show(Inspection $inspection_id) 
    {
        // Rename the incoming variable parameter to $inspection to cleanly match your Blade view expectation
        $inspection = $inspection_id;

        return view('inspections.show', compact('inspection'));
    }

    public function edit($inspection_id)
    {
        // Explicitly query the database using the incoming URL identifier string
        $inspection = Inspection::where('inspection_id', $inspection_id)->firstOrFail();
        
        // Fetch your dropdown dependencies (which your logs show you already have)
        $properties = Property::all();
        $staff = Staff::all();
    
        // Pass everything clean to your view template layout
        return view('inspections.edit', compact('inspection', 'properties', 'staff'));
    }
    

    public function update(Request $request, Inspection $inspection_id)
{
    // 1. Rename the variable internally for cleaner reading
    $inspection = $inspection_id;

    // 2. Validate incoming request data
    $validated = $request->validate([
        'property_id'     => 'required',
        'staff_id'        => 'required',
        'inspection_date' => 'required|date', 
        'comments'        => 'nullable|string',
    ]);

    // 3. Perform the update directly with the validated data array
    $inspection->update($validated);

    // 4. Redirect explicitly passing the custom primary key parameter
    return redirect()
        ->route('inspections.show', ['inspection_id' => $inspection->inspection_id])
        ->with('success', 'Inspection updated successfully.');
}


    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return redirect()
            ->route('inspections.index')
            ->with('success', 'Inspection deleted successfully.');
    }
}