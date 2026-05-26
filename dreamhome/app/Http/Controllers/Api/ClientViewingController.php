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
            'property_id' => 'required|exists:properties,property_id',
            'comments' => 'nullable|string',
        ]);

        $client = $request->user();

        if (!$client) {
            return response()->json([
                'message' => 'Unauthenticated client.',
            ], 401);
        }

        // Generate new viewing_id like V001, V002, V003...
        $lastViewing = Viewing::orderBy('viewing_id', 'desc')->first();

        if ($lastViewing) {
            $lastNumber = (int) substr($lastViewing->viewing_id, 1);
            $newNumber = $lastNumber + 1;
            $newViewingId = 'V' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newViewingId = 'V001';
        }

        $viewing = Viewing::create([
            'viewing_id' => $newViewingId,
            'client_id' => $client->client_id,
            'property_id' => $request->property_id,

            // Staff/web side will set these later
            'view_date' => null,
            'staff_id' => null,

            'comments' => $request->comments,
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
            ->orderBy('viewing_id', 'desc')
            ->get();

        return response()->json([
            'message' => 'My viewings loaded successfully.',
            'data' => $viewings,
        ], 200);
    }
}