<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;

class ClientRegisterController extends Controller
{
    /**
     * Show the registration view.
     */
    public function create()
    {
        return view('auth.client-register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Server-Side Data Validation
        $request->validate([
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'address'      => ['required', 'string'],
            'telephone_no' => ['required', 'string', 'max:20'],
            'prefer_type'  => ['required', 'string', 'in:Flat,Studio,Apartment,Condo,House'],
            'max_rent'     => ['required', 'numeric', 'min:0'],
        ]);

        // 2. Auto-Generate the Custom Client ID
        $clientId = $this->generateClientId();

        // 3. Store into the PostgreSQL Database Table
        $client = Client::create([
            'client_id'    => $clientId,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'address'      => $request->address,
            'telephone_no' => $request->telephone_no,
            'prefer_type'  => $request->prefer_type,
            'max_rent'     => $request->max_rent,
            'password'     => Hash::make($request->password), // Cryptographically hashed
        ]);

        // 4. Log the client into their session using your specific guard
        auth()->guard('client')->login($client);

        // 5. Redirect to their new profile entry layout
        return redirect()->intended('/client/dashboard');
    }

    /**
     * Auto-generates a formatted sequential Client ID (e.g., CL0001, CL0002)
     */
    private function generateClientId(): string
    {
        // Grabs the last record based on sorting the alphanumeric primary key descending
        $lastClient = Client::orderBy('client_id', 'desc')->first();

        if (!$lastClient) {
            return 'CL0001'; // Fallback seed for the very first entry
        }

        // Extracts the digits from the ID string (e.g., extracts "0001" from "CL0001")
        $lastNumber = (int) substr($lastClient->client_id, 2);
        $nextNumber = $lastNumber + 1;

        // Pads the incremented digits back to standard format sizing lengths (4 digits)
        return 'CL' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}