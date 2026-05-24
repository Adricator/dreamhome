<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        // Get search input
        $query = $request->input('search');

        // Fetch owners with optional search
        $owners = Owner::when($query, function ($q) use ($query) {
            return $q->where('first_name', 'like', "%{$query}%")
                     ->orWhere('last_name', 'like', "%{$query}%");
        })->get();


        return view('owners.index', compact('owners'));
    }
    public function create()
    {
        return view('owners.create');
    }
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'address'      => 'nullable|string',
            'telephone_no' => 'required|string|max:50',
            'email'        => 'required|email|unique:owners,email',
        ]);
        $latestOwner = Owner::orderBy('owner_id', 'desc')->first();

        if (!$latestOwner) {
            $newOwnerId = 'OW0001';
        } else {
            $number = filter_var($latestOwner->owner_id, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = intval($number) + 1;
            $newOwnerId = 'OW' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }
        $validatedData['owner_id'] = $newOwnerId;
        Owner::create($validatedData);

        return redirect()->route('owners.index')->with('success', "Owner {$newOwnerId} registered successfully!");
    }
    public function show($owner_id)
    {
        // Find the owner and automatically append a 'properties_count' attribute to the object
        $owner = Owner::where('owner_id', $owner_id)
            ->withCount('properties') 
            ->firstOrFail();

        return view('owners.show', compact('owner'));
    }
    public function edit($owner_id)
    {
        $owner = Owner::where('owner_id', $owner_id)->firstOrFail();
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request,$owner_id)
    {
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'address'      => 'nullable|string',
            'telephone_no' => 'required|string|max:50',
            'email'        => 'required|email',
        ]);
        $owner = Owner::where('owner_id', $owner_id)->firstOrFail();
        $owner->update($validatedData);
        return redirect()->route('owners.index')->with('success', 'Owner updated successfully!');
    }

    public function destroy($owner_id)
    {
        // 1. Locate the record using your string token identifier
        $owner = Owner::where('owner_id', $owner_id)->firstOrFail();

        try {
            // 2. Attempt the atomic database deletion
            $owner->delete();

            return redirect()->route('owners.index')
                ->with('success', "Owner {$owner_id} record successfully removed.");

        } catch (QueryException $e) {
            // 3. Check if the error code matches a Foreign Key Constraint violation (SQLSTATE 23503)
            if ($e->getCode() === '23503') {
                return redirect()->route('owners.index')
                    ->with('error', "Cannot delete Owner [{$owner_id}]. This record is still linked to active properties or advertisement listings. Please delete or reassign those dependent items first.");
            }

            // 4. Fallback safeguard for any other unhandled database anomalies
            return redirect()->route('owners.index')
                ->with('error', "An unexpected system error occurred while deleting the record.");
        }
    }
}