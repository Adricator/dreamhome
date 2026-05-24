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
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('comments', 'like', "%{$search}%");
            });
        }

        $viewings = $query->orderBy('id', 'desc')->get();

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
            'client_id' => 'required|string|exists:clients,client_id',
            'property_id' => 'required|string|exists:properties,property_id',
            'view_date' => 'required|date',
            'staff_id' => 'nullable|string|exists:staff,staff_id',
            'comments' => 'nullable|string',
            'status' => 'required|string|in:Pending,Approved,Completed,Cancelled',
        ]);

        Viewing::create([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'view_date' => $request->view_date,
            'staff_id' => $request->staff_id,
            'comments' => $request->comments,
            'status' => $request->status,
        ]);

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
        $viewing->load(['client', 'property', 'staff']);

        $clients = Client::orderBy('client_id')->get();
        $properties = Property::orderBy('property_id')->get();
        $staff = Staff::orderBy('staff_id')->get();

        return view('viewings.edit', compact('viewing', 'clients', 'properties', 'staff'));
    }

    public function update(Request $request, Viewing $viewing)
    {
        $request->validate([
            'client_id' => 'required|string|exists:clients,client_id',
            'property_id' => 'required|string|exists:properties,property_id',
            'view_date' => 'required|date',
            'staff_id' => 'nullable|string|exists:staff,staff_id',
            'comments' => 'nullable|string',
            'status' => 'required|string|in:Pending,Approved,Completed,Cancelled',
        ]);

        $viewing->update([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'view_date' => $request->view_date,
            'staff_id' => $request->staff_id,
            'comments' => $request->comments,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('viewings.index')
            ->with('success', 'Viewing record updated successfully.');
    }

    public function destroy(Viewing $viewing)
    {
        $viewing->delete();

        return redirect()
            ->route('viewings.index')
            ->with('success', 'Viewing record deleted successfully.');
    }
}