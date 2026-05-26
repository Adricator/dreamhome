<?php

namespace App\Http\Controllers;

use App\Models\Viewing;
use App\Models\Client;
use App\Models\Property;
use App\Models\Staff;
use Illuminate\Http\Request;

class ViewingController extends Controller
{
    public function index(Request $request)
    {
        $query = Viewing::with(['client', 'property', 'staff']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('client_id', 'like', "%{$search}%")
                    ->orWhere('property_id', 'like', "%{$search}%")
                    ->orWhere('staff_id', 'like', "%{$search}%")
                    ->orWhere('comments', 'like', "%{$search}%");
            });
        }

        $viewings = $query->orderBy('view_date', 'desc')->get();

        return view('viewings.index', compact('viewings'));
    }

    public function create()
    {
        $clients = Client::orderBy('client_id')->get();
        $properties = Property::orderBy('property_id')->get();
        $staff = Staff::orderBy('staff_id')->get();

        return view('viewings.create', compact('clients', 'properties', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string|max:20|exists:clients,client_id',
            'property_id' => 'required|string|max:20|exists:properties,property_id',
            'view_date' => 'required|date',
            'staff_id' => 'nullable|string|max:20|exists:staff,staff_id',
            'comments' => 'nullable|string',
        ]);

        Viewing::create($request->only([
            'client_id',
            'property_id',
            'view_date',
            'staff_id',
            'comments',
        ]));

        return redirect()
            ->route('viewings.index')
            ->with('success', 'Viewing record created successfully.');
    }

    public function show(Viewing $viewing)
    {
        $viewing->load(['client', 'property', 'staff']);

        return view('viewings.show', compact('viewing'));
    }

    public function edit(Viewing $viewing)
    {
        $clients = Client::orderBy('client_id')->get();
        $properties = Property::orderBy('property_id')->get();
        $staff = Staff::orderBy('staff_id')->get();
        
        return view('viewings.edit', compact('viewing', 'clients', 'properties', 'staff'));
    }

    public function update(Request $request, $client_id)
{
    // Retrieve the other two parts of your composite key from the query string
    $property_id = $request->query('property_id');
    $view_date = $request->query('view_date');

    $request->validate([
        'client_id' => 'required',
        'property_id' => 'required',
        'view_date' => 'required|date',
    ]);

    // Find the exact record
    $viewing = Viewing::where('client_id', $client_id)
                      ->where('property_id', $property_id)
                      ->where('view_date', $view_date)
                      ->firstOrFail();
    $viewing->update($request->only([
        'client_id',
        'property_id',
        'view_date',
        'staff_id',
        'comments',
    ]));

    return redirect()->route('viewings.index')->with('success', 'Viewing updated successfully.');
}

    public function destroy(Viewing $viewing)
{
    $viewing->delete();

    return redirect()->route('viewings.index')->with('success', 'Viewing deleted successfully');
}
    }