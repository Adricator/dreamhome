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

    public function show(Inspection $inspection)
    {
        return view('inspections.show', compact('inspection'));
    }

   public function edit(Inspection $inspection)
    {
        $properties = Property::all();
        $staffs = Staff::all();
        // Add 'properties' and 'staffs' to the compact array
        return view('inspections.edit', compact('inspection', 'properties', 'staffs')); 
    }
    public function update(Request $request, Inspection $inspection)
{
    // 1. Add the missing validation block back:
    $validated = $request->validate([
        'property_id'     => 'required',
        'staff_id'        => 'required',
        'inspection_date' => 'required|date', 
        'comments'        => 'nullable|string',
    ]);

    // 2. This part is already there, it will now recognize $validated!
    $inspection->update([
        'property_id'     => $validated['property_id'],
        'staff_id'        => $validated['staff_id'],
        'inspection_date' => $validated['inspection_date'], 
        'comments'        => $validated['comments'],        
    ]);

    return redirect()
        ->route('inspections.show', $inspection)
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