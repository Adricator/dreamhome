<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;

class ClientPropertyController extends Controller
{
    public function index()
    {
        return response()->json(Property::all());
    }

    public function show($id)
    {
        return response()->json(Property::findOrFail($id));
    }
}