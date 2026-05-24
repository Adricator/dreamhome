<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'telephone_no' => 'nullable|string|max:50',
            'email' => 'required|email|unique:clients,email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/',
            ],
            'prefer_type' => 'nullable|string|max:50',
            'max_rent' => 'nullable|numeric',
        ], [
            'password.min' => 'Password must be at least 6 characters long.',
            'password.regex' => 'Password must contain at least one letter, one number, and one special character.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Registration failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $clientId = $this->generateClientId();

        $client = Client::create([
            'client_id' => $clientId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'telephone_no' => $request->telephone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prefer_type' => $request->prefer_type,
            'max_rent' => $request->max_rent,
        ]);

        $token = $client->createToken('client_token')->plainTextToken;

        return response()->json([
            'message' => 'Client registered successfully.',
            'client' => $client,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Please enter a valid email and password.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 401);
        }

        $token = $client->createToken('client_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'client' => $client,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }

    private function generateClientId()
    {
        $latestClient = Client::orderBy('client_id', 'desc')->first();

        if (!$latestClient) {
            return 'CL001';
        }

        $latestNumber = (int) substr($latestClient->client_id, 2);
        $newNumber = $latestNumber + 1;

        return 'CL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}