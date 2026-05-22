<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request)
    {
        $query = Staff::query();

        // Optional search logic
        if ($request->has('search')) {
            $query->where('first_name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('last_name', 'ilike', '%' . $request->search . '%')
                  ->orWhere('staff_id', 'ilike', '%' . $request->search . '%');
        }

        $staffMembers = $query->get();
        return view('staff.index', compact('staffMembers'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        // Validated data comes from your StoreStaffRequest
        Staff::create($request->validated());

        return redirect()->route('staff.index')
                         ->with('success', 'Staff member added successfully.');
    }

    /**
     * Display the specified staff member.
     */
    public function show($staff_id)
    {
        // Query using your custom primary key column
        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        // Pass it to the view explicitly as 'staff'
        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit($staff_id) // <-- CHANGE THIS from $staff to $staff_id
    {
        // Query using the incoming $staff_id
        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        // Pass it to the view as 'staff' so your edit form layout works
        return view('staff.edit', compact('staff'));
    }
    /**
     * Update the specified staff member in storage.
     */
    public function update(UpdateStaffRequest $request, $staff_id) // <-- Receive the raw ID string
    {
        // Find the record using your custom primary key column
        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        // Persist the verified form data safely to your database
        $staff->update($request->validated());

        return redirect()->route('staff.index')
                        ->with('success', 'Staff information updated.');
    }

    public function destroy($staff_id) // <-- Change from (Staff $staff) to receive the raw ID string
    {
        // Locate the record explicitly via your custom string primary key
        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        // Delete the record from your PostgreSQL database
        $staff->delete();

        return redirect()->route('staff.index')
                        ->with('success', 'Staff record permanently deleted.');
    }
}