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
            'client_id' => 'required',
            'property_id' => 'required',
            'view_date' => 'required',
            'staff_id' => 'required',
        ]);

        $viewing = Viewing::create([
            'client_id' => $request->client_id,
            'property_id' => $request->property_id,
            'view_date' => $request->view_date,
            'staff_id' => $request->staff_id,
        ]);

        return response()->json([
            'message' => 'Viewing request submitted',
            'data' => $viewing
        ]);
    }

    public function myViewings()
    {
        return response()->json(
            Viewing::all()
        );
    }
}