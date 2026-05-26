<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Branch::with('manager');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('branch_id', 'ILIKE', "%{$search}%")
                ->orWhere('city', 'ILIKE', "%{$search}%")
                ->orWhere('street', 'ILIKE', "%{$search}%")
                ->orWhere('area', 'ILIKE', "%{$search}%")
                ->orWhere('postcode', 'ILIKE', "%{$search}%");
            });
        }
        $branches = $query->get();
        return view('branches.index', compact('branches')); 
    }
    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'street'       => 'required|string',
            'city'         => 'required|string|max:255',
            'postcode'     => 'required|string|max:50',
            'area'         => 'required|string|max:255',
            'telephone_no' => 'required|string|max:50',
            'fax_no'       => 'nullable|string|max:50',
        ]);

        $latestBranch = Branch::orderBy('branch_id', 'desc')->first();

        if (!$latestBranch) {
            $newBranchId = 'B0001';
        } else {
            $number = filter_var($latestBranch->branch_id, FILTER_SANITIZE_NUMBER_INT);
            
            $nextNumber = intval($number) + 1;

            $newBranchId = 'B' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }
        $validatedData['branch_id'] = $newBranchId;

        // 4. Create the new row in PostgreSQL
        Branch::create($validatedData);

        return redirect()->route('branches.index')
            ->with('success', "Branch {$newBranchId} was successfully registered!");
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing a specific branch.
     */
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    /**
     * Update the branch details.
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validated = $request->validate([
            'street'       => 'required|string',
            'area'         => 'required|string',
            'city'         => 'required|string',
            'postcode'     => 'required|string',
            'telephone_no' => 'nullable|string|max:50',
            'fax_no'       => 'nullable|string|max:50',
        ]);

        $branch->update($validated);

        return redirect()->route('branches.index')
                         ->with('success', 'Branch updated successfully!');
    }


    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')
                         ->with('success', 'Branch deleted successfully.');
    }
}