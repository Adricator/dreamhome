<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspection::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('property_id', 'LIKE', "%{$search}%")
                  ->orWhere('staff_id', 'LIKE', "%{$search}%")
                  ->orWhere('comments', 'LIKE', "%{$search}%");
        }

        $inspections = $query->get();

        return view('inspections.index', compact('inspections'));
    }

   public function create()
    {
        $properties = Property::all();
        $staffMembers = Staff::all();

        return view('inspections.create', compact('properties', 'staffMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id'     => 'required|string|max:20',
            'inspection_date' => 'required|date',
            'staff_id'        => 'required|string|max:20',
            'comments'        => 'nullable|string',
        ]);

        Inspection::create($validated);

        return redirect()->route('inspections.index')->with('success', 'Inspection logged successfully.');
    }

    public function show(Inspection $inspection)
    {
        return view('inspections.show', compact('inspection'));
    }

    public function edit(Inspection $inspection)
    {
        return view('inspections.edit', compact('inspection'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([
            'property_id'     => 'required|string|max:20',
            'inspection_date' => 'required|date',
            'staff_id'        => 'required|string|max:20',
            'comments'        => 'nullable|string',
        ]);

        $inspection->update($validated);

        return redirect()->route('inspections.index')->with('success', 'Inspection updated successfully.');
    }

    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return redirect()->route('inspections.index')->with('success', 'Inspection deleted successfully.');
    }
}