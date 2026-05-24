<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viewing;

class ClientViewingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
        ]);

        $client = $request->user();

        if (!$client) {
            return response()->json([
                'message' => 'Unauthenticated client.',
            ], 401);
        }

        $viewing = Viewing::create([
            'client_id' => $client->client_id,
            'property_id' => $request->property_id,
            'view_date' => null,
            'staff_id' => null,
            'status' => 'Pending',
        ]);

        return response()->json([
            'message' => 'Viewing request submitted. Please wait for admin approval.',
            'data' => $viewing,
        ], 201);
    }

    public function myViewings(Request $request)
    {
        $client = $request->user();

        if (!$client) {
            return response()->json([
                'message' => 'Unauthenticated client.',
            ], 401);
        }

        $viewings = Viewing::with(['property', 'staff'])
            ->where('client_id', $client->client_id)
            ->orderByRaw('view_date IS NULL ASC')
            ->orderBy('view_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'message' => 'My viewings loaded successfully.',
            'data' => $viewings,
        ], 200);
    }
}