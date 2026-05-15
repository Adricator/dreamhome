<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $branches = Branch::all();
        // return view('branches.index', compact('branches'));
        $branches = Branch::with('manager')->get();
        return view('branches.index', compact('branches')); 
    }

    /**
     * Show the form for creating a new branch.
     */
    public function create()
    {
        return view('branches.create');
    }

    /**
     * Store a newly created branch in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'    => 'required|string|max:20|unique:branches,branch_id',
            'street'       => 'required|string',
            'area'         => 'required|string',
            'city'         => 'required|string',
            'postcode'     => 'required|string',
            'telephone_no' => 'nullable|string|max:50',
            'fax_no'       => 'nullable|string|max:50',
        ]);

        Branch::create($validated);

        return redirect()->route('branches.index')
                         ->with('success', 'Branch added successfully!');
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




    /**
     * Remove the branch.
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')
                         ->with('success', 'Branch deleted successfully.');
    }
}