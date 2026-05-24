<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Requests\UpdateNextOfKinRequest;
use App\Models\NextOfKin;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use Illuminate\Http\JsonResponse;

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
                  ->orWhere('staff_id', 'ilike', '%' . $request->search . '%')
                  ->orWhere('position', 'ilike', '%' . $request->search . '%');
        }

        $staffMembers = $query->get();
        return view('staff.index', compact('staffMembers'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        $positions = ['manager', 'supervisor', 'secretary', 'staff'];
        $sex_options = ['male', 'female'];
        $branches = \App\Models\Branch::all();

        return view('staff.create', compact('positions', 'sex_options', 'branches'));
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(StoreStaffRequest $request)
    {
        $validated = $request->validated();

        // Safe auto-incrementing key sequencer for PostgreSQL
        $lastStaff = \App\Models\Staff::select('staff_id')
            ->where('staff_id', 'ILIKE', 'ST%')
            ->orderByRaw('CAST(SUBSTRING(staff_id FROM 3) AS INTEGER) DESC')
            ->first();

        if ($lastStaff) {
            $number = intval(substr($lastStaff->staff_id, 2)) + 1;
            $nextStaffId = 'ST' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $nextStaffId = 'ST0001';
        }
        
        DB::transaction(function () use ($validated, $nextStaffId, $request) {
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


            NextOfKin::create([
                'staff_id'     => $nextStaffId,
                'full_name'    => $request->input('nok_name'), 
                'relationship' => $request->input('nok_relationship'),
                'telephone_no' => $request->input('nok_telephone_no'),
                'address'      => $request->input('nok_address'),
            ]);
        });

        return redirect()->route('staff.index')->with('success', 'New staff records registered successfully!');
    }

    public function show($staff_id)
    {
        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        return view('staff.show', compact('staff'));
    }

    public function edit($id)
    {
        $staff = \App\Models\Staff::with('nextOfKin')->where('staff_id', $id)->firstOrFail();
        $positions = ['manager', 'supervisor', 'secretary', 'staff'];
        $sex_options = ['male', 'female']; 
        $branches = \App\Models\Branch::all();

        return view('staff.edit', compact('staff', 'positions', 'sex_options', 'branches'));
    }

    // 1. Swap Request with UpdateStaffRequest in the method parameters
    public function update(\App\Http\Requests\UpdateStaffRequest $request, $id)
    {
        // Find the staff record
        $staff = \App\Models\Staff::where('staff_id', $id)->firstOrFail();

        // 2. Run the Next of Kin validation manually from your separate Form Request rules
        $nokRequest = new \App\Http\Requests\UpdateNextOfKinRequest();
        $nokValidator = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            $nokRequest->rules(),
            $nokRequest->messages()
        );

        if ($nokValidator->fails()) {
            return redirect()->back()->withErrors($nokValidator)->withInput();
        }

        // 3. Update the main Staff table data using your validated data rules
        $staff->update([
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'dob'               => $request->dob,
            'sex'               => $request->sex,
            'email'             => $request->email,
            'telephone_no'      => $request->telephone_no,
            'address'           => $request->address,
            'position'          => $request->position,
            'salary'            => $request->salary,
            'nin'               => $request->nin,
            'branch_id'         => $request->branch_id,
            'supervised_by'     => $request->position === 'staff' ? $request->supervised_by : null,
            'car_allowance'     => $request->position === 'manager' ? $request->car_allowance : null,
            'performance_bonus' => $request->position === 'manager' ? $request->performance_bonus : null,
            'typing_speed_wpm'  => $request->position === 'secretary' ? $request->typing_speed_wpm : null,
        ]);

        // 4. FIXED MAPPING: Link form fields ($request->nok_*) to database columns ('full_name', 'relationship', etc.)
        $staff->nextOfKin()->updateOrCreate(
            ['staff_id' => $staff->staff_id], 
            [
                'full_name'    => $request->nok_name,
                'relationship' => $request->nok_relationship,
                'telephone_no' => $request->nok_telephone_no,
                'address'      => $request->nok_address,
            ]
        );

        // Redirect back to list with success state indicator
        return redirect()->route('staff.index')->with('success', 'Staff and Next of Kin records updated successfully!');
    }

    public function destroy($staff_id) 
    {

        $staff = Staff::where('staff_id', $staff_id)->firstOrFail();

        DB::transaction(function () use ($staff, $staff_id) {
            
            NextOfKin::where('staff_id', $staff_id)->delete();

            $staff->delete();
        });

        return redirect()
            ->route('staff.index')
            ->with('success', 'Staff member and their associated Next of Kin record have been permanently removed.');
    }

    public function getSupervisorsByBranch($branch_id): JsonResponse
    {
        $supervisors = Staff::where('branch_id', $branch_id)
            ->whereIn(DB::raw('LOWER(position)'), ['supervisor'])
            ->select('staff_id', 'first_name', 'last_name')
            ->get();

        return response()->json($supervisors);
    }
}