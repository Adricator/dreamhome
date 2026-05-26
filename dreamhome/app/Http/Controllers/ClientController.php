<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
          $searchTerm = $request->input('search');

    $clients = Client::query()
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('first_name', 'ILIKE', "%{$searchTerm}%")
                         ->orWhere('last_name', 'ILIKE', "%{$searchTerm}%")
                         ->orWhere('client_id', 'ILIKE', "%{$searchTerm}%")
                         ->orWhere('email', 'ILIKE', "%{$searchTerm}%");
        })
        ->get();

    return view('clients.index', compact('clients'));

    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'    => 'required|string|max:20|unique:clients,client_id',
            'first_name'   => 'required|string|max:20',
            'last_name'    => 'required|string|max:20',
            'address'      => 'required|string',
            'telephone_no' => 'required|string|max:13',
            'email'        => 'required|email',
            'prefer_type'  => 'nullable|string',
            'max_rent'     => 'nullable|numeric', // Validated as numeric for logic
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client registered successfully.');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
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