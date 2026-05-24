<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Staff;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Client;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $query = $request->search;

        $properties = Property::where('street', 'ILIKE', "%{$query}%")
            ->orWhere('city', 'ILIKE', "%{$query}%")
            ->get();

        $branches = Branch::where('city', 'ILIKE', "%{$query}%")
            ->get();

        $staff = Staff::where('first_name', 'ILIKE', "%{$query}%")
            ->orWhere('last_name', 'ILIKE', "%{$query}%")
            ->get();

        $privateOwners = Owner::where('first_name', 'ILIKE', "%{$query}%")
            ->orWhere('last_name', 'ILIKE', "%{$query}%")
            ->get();

        $clients = Client::where('first_name', 'ILIKE', "%{$query}%")
            ->orWhere('last_name', 'ILIKE', "%{$query}%")
            ->get();

        return view('search-results', compact(
            'query',
            'properties',
            'staff',
            'private-owners',
            'branches',
            'clients'
        ));
    }
}