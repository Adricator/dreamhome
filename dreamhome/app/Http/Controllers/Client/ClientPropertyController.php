<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ClientPropertyController extends Controller
{
    /**
     * Display strict preference matches alongside the complete property catalog.
     */
    public function index(): View
    {
        $client = Auth::guard('client')->user();
        
        // Use strtolower and trim to safely normalize the client preference string
        $prefType = !empty($client->prefer_type) ? strtolower(trim($client->prefer_type)) : null;
        $maxRent = (!empty($client->max_rent) && $client->max_rent > 0) ? $client->max_rent : null;

        // --- SECTION 1: STRICT MATCHES ---
        if ($prefType && $maxRent) {
            $matchedProperties = Property::whereRaw('LOWER(type) = ?', [$prefType]) // Force case-insensitive match
                ->where('monthly_rent', '<=', $maxRent)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $matchedProperties = collect();
        }
        
        // --- SECTION 2: ALL PROPERTIES ---
        $allProperties = Property::orderBy('created_at', 'desc')->get();

        return view('client.properties.index', compact('matchedProperties', 'allProperties', 'client'));
    }

    public function show($id)
    {
        $property = \App\Models\Property::with(['owner', 'staff'])->findOrFail($id);
        $client = auth()->guard('client')->user();
        
        return view('client.properties.show', compact('property', 'client'));
    }
}