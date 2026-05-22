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
                // Adjust 'branch_id' and 'city' to match your actual column names
                $q->where('branch_id', 'ILIKE', "%{$search}%")
                ->orWhere('city', 'ILIKE', "%{$search}%");
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