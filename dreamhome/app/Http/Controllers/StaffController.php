<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\NextOfKin;
use Illuminate\Support\Facades\DB;

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
        $positions = \App\Models\Staff::whereNotNull('position')
        ->distinct()
        ->pluck('position');

    // 2. Fetch unique sex value variants (e.g., outputs ['M', 'F'] or ['male', 'female'] based on your entries)
        $sex_options = \App\Models\Staff::whereNotNull('sex')
            ->distinct()
            ->pluck('sex');
        // 3. Compact and send both lookup variables safely down to the frontend asset layout
        return view('staff.create', compact('positions', 'sex_options'));
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(StoreStaffRequest $request)
{
    $validated = $request->validated();

    // Safe auto-incrementing key sequencer for PostgreSQL
    $lastStaff = \App\Models\Staff::select('staff_id')
        ->where('staff_id', 'LIKE', 'ST%')
        ->orderByRaw('CAST(SUBSTRING(staff_id FROM 3) AS INTEGER) DESC')
        ->first();

    if ($lastStaff) {
        $number = intval(substr($lastStaff->staff_id, 2)) + 1;
        $nextStaffId = 'ST' . str_pad($number, 4, '0', STR_PAD_LEFT);
    } else {
        $nextStaffId = 'ST0001';
    }
    
    DB::transaction(function () use ($validated, $nextStaffId, $request) {
            
        // Create main staff profile record row
        Staff::create([
            'staff_id'          => $nextStaffId,
            'first_name'        => $validated['first_name'],
            'last_name'         => $validated['last_name'],
            'dob'               => $validated['dob'],
            'email'             => $validated['email'],
            'telephone_no'      => $validated['telephone_no'],
            'address'           => $validated['address'], 
            'position'          => $validated['position'],
            'salary'            => $validated['salary'],
            'nin'               => $validated['nin'],
            'sex'               => $validated['sex'],
            'branch_id'         => $validated['branch_id'],
            'car_allowance'     => $request->filled('car_allowance') ? $validated['car_allowance'] : null,
            'performance_bonus' => $request->filled('performance_bonus') ? $validated['performance_bonus'] : null,
            'typing_speed_wpm'  => $request->filled('typing_speed_wpm') ? $validated['typing_speed_wpm'] : null,
            'supervised_by'     => $request->filled('supervised_by') ? $validated['supervised_by'] : null,
        ]);

        // Create Next of Kin record using the exact same calculated staff_id key
        NextOfKin::create([
    'staff_id'     => $nextStaffId,
    'full_name'    => $request->input('nok_name'), 
    'relationship' => $request->input('nok_relationship'),
    'telephone_no' => $request->input('nok_telephone_no'),
    'address'      => $request->input('nok_address'),
]);
    });

    return redirect()
        ->route('staff.index')
        ->with('success', 'New staff records registered successfully!');
}

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

    public function destroy($staff_id) 
{
    // 1. Locate the core staff record explicitly via your custom string primary key
    $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

    // 2. Use a transaction block to handle cascading deletions safely
    DB::transaction(function () use ($staff, $staff_id) {
        
        // Delete the dependent Next of Kin record first to satisfy foreign key constraints
        NextOfKin::where('staff_id', $staff_id)->delete();

        // Now safe to delete the parent staff record
        $staff->delete();
    });

    return redirect()
        ->route('staff.index')
        ->with('success', 'Staff member and their associated Next of Kin record have been permanently removed.');
}
}