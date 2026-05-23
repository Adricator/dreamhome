<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viewing;
use App\Models\Staff;

class ClientViewingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'view_date' => 'required|date',
        ]);

        $client = $request->user();

        if (!$client) {
            return response()->json([
                'message' => 'Unauthenticated client.',
            ], 401);
        }

        /*
         * For now, automatically assign the first staff member.
         * This avoids requiring the mobile app to manually send staff_id.
         */
        $staff = Staff::first();

        if (!$staff) {
            return response()->json([
                'message' => 'No staff available to assign this viewing.',
            ], 422);
        }

        $viewing = Viewing::create([
            'client_id' => $client->client_id,
            'property_id' => $request->property_id,
            'view_date' => $request->view_date,
            'staff_id' => $staff->staff_id,
        ]);

        return response()->json([
            'message' => 'Viewing request submitted successfully.',
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
            ->orderBy('view_date', 'desc')
            ->get();

        return response()->json([
            'message' => 'My viewings loaded successfully.',
            'data' => $viewings,
        ], 200);
    }
}