<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Staff;
use App\Models\PrivateOwner;
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

        $properties = Property::where('street', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->get();

        $branches = Branch::where('city', 'LIKE', "%{$query}%")
            ->get();

        $staff = Staff::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->get();

        $privateOwners = PrivateOwner::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->get();

        $clients = Client::where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
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