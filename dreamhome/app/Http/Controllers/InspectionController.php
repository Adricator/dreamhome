<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateInspectionRequest;

class InspectionController extends Controller
{
    // app/Http/Controllers/InspectionController.php

    public function index()
    {
        // This 'property' here is what was causing the crash
        $inspections = Inspection::with(['property', 'staff'])->get(); 
        
        return view('inspections.index', compact('inspections'));
    }

    public function store(StoreInspectionRequest $request)
    {

    $validated = $request->validate([
            'property_id'      => 'required|string|max:20',
            'inspection_date' => 'required|date',
            'staff_id'        => 'required|string|max:20',
            'comments'        => 'nullable|string',
        ]);
        // Use the data already validated by the StoreInspectionRequest
        Inspection::create($request->validated());

        return redirect()->route('inspections.index')
                         ->with('success', 'Inspection recorded successfully.');
    }

    // Fixed: Removed Route Model Binding since you are using composite keys
    public function show($property_id, $inspection_date)
    {
        $inspection = Inspection::where('property_id', $property_id)
            ->where('inspection_date', $inspection_date)
            ->firstOrFail();

        return view('inspections.show', compact('inspection'));
    }

    public function edit($property_id, $inspection_date)
    {
        // Fixed the typo: $propert_id -> $property_id
        $inspection = Inspection::where('property_id', $property_id)
            ->where('inspection_date', $inspection_date)
            ->firstOrFail();

        return view('inspections.edit', compact('inspection'));
    }

    public function update(UpdateInspectionRequest $request, $property_id, $inspection_date)
    {
        // Recommended: Use the UpdateInspectionRequest for validation logic
        Inspection::where('property_id', $property_id)
            ->where('inspection_date', $inspection_date)
            ->update($request->validated());

        return redirect()->route('inspections.index')
                         ->with('success', 'Inspection updated successfully.');
    }

    public function destroy($property_id, $inspection_date)
    {
        Inspection::where('property_id', $property_id)
            ->where('inspection_date', $inspection_date)
            ->delete();

        return redirect()->route('inspections.index')
                         ->with('success', 'Inspection deleted successfully.');
    }
}