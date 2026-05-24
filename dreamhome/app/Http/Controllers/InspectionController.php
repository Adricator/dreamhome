<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $inspections = Inspection::when($search, function ($query, $search) {
            $query->where('property_id', 'like', "%{$search}%")
                  ->orWhere('staff_id', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
        })
        ->orderBy('inspection_id', 'desc')
        ->get();

        return view('inspections.index', compact('inspections'));
    }

    public function create()
    {
        return view('inspections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|string|max:255',
            'staff_id' => 'required|string|max:255',
            'date' => 'required|date',
            'comment' => 'nullable|string',
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
        return view('inspections.edit', compact('inspection'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $validated = $request->validate([
            'property_id' => 'required|string|max:255',
            'staff_id' => 'required|string|max:255',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        $inspection->update($validated);

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