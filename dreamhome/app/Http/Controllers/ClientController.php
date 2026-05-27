<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $clients = Client::with('branch')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('first_name', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('last_name', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('client_id', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'ILIKE', "%{$searchTerm}%")
                    ->orWhere('branch_id', 'ILIKE', "%{$searchTerm}%");
            })
            ->get();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $branches = Branch::orderBy('branch_id')->get();

        return view('clients.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'    => 'required|string|max:20|unique:clients,client_id',
            'password'     => 'required|string|min:6',
            'first_name'   => 'required|string|max:20',
            'last_name'    => 'required|string|max:20',
            'address'      => 'required|string',
            'telephone_no' => 'required|string|max:13',
            'email'        => 'required|email',
            'prefer_type'  => 'nullable|string',
            'max_rent'     => 'nullable|numeric', // Validated as numeric for logic
            'branch_id'    => 'nullable|exists:branches,branch_id',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client registered successfully.');
    }

    public function show($id)
    {
        $client = Client::with('branch')->findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $branches = Branch::orderBy('branch_id')->get();

        return view('clients.edit', compact('client', 'branches'));
    }


    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'first_name'   => 'required|string|max:20',
            'last_name'    => 'required|string|max:20',
            'address'      => 'required|string',
            'telephone_no' => 'required|string|max:13',
            'email'        => 'required|email',
            'prefer_type'  => 'nullable|string',
            'max_rent'     => 'nullable|numeric', // Validated as numeric for logic
            'branch_id'    => 'nullable|exists:branches,branch_id',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

  

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
