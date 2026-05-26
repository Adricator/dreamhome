<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Owner;
use App\Models\Branch;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Http\JsonResponse;


class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // 1. Start a single query builder instance
        $query = Property::query();

        // 2. Global Text Search Block (Maintained correctly now!)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('street', 'ILIKE', "%{$search}%")
                ->orWhere('city', 'ILIKE', "%{$search}%")
                ->orWhere('area', 'ILIKE', "%{$search}%")
                ->orWhere('postcode', 'ILIKE', "%{$search}%")
                ->orWhere('property_id', 'ILIKE', "%{$search}%");
            });
        }

        // REMOVED: The duplicate $query = Property::query() that was wiping your search!

        // 3. Dropdown & Property Type Filters
        if ($request->filled('type')) {
            // Using ILIKE ensures 'condo', 'Condo', or 'CONDO' all match flawlessly in PostgreSQL
            $query->where('type', 'ILIKE', $request->type);
        }
        
        if ($request->filled('status')) {
        $query->where('status', 'ILIKE', $request->status);
        }
        
        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }
        
        if ($request->filled('price_range')) {
            $prices = explode('-', $request->price_range);
            if (count($prices) === 2) {
                $query->whereBetween('monthly_rent', [(int)$prices[0], (int)$prices[1]]);
            }
        }
        
        if ($request->filled('location')) {
            $query->where('city', 'ILIKE', $request->location);
        }

        // 4. Fetch the filtered results
        $properties = $query->get();

        return view('properties.index', compact('properties'));
    }

    public function create(Request $request)
    {
        $owners = Owner::all();
        $branches = Branch::all();
        $selectedOwnerId = $request->query('owner_id');

        $types = ['studio', 'house', 'condo', 'apartment', 'flat'];

        return view('properties.create', compact('owners', 'branches', 'selectedOwnerId', 'types'));
    }
    

    public function store(Request $request)
    {
        // 1. Run your field validation parameters safely
        $validated = $request->validate([
            'street'       => 'required|string|max:255',
            'city'         => 'nullable|string|max:255',
            'postcode'     => 'nullable|string|max:20',
            'type'         => 'required|string',
            'rooms'        => 'nullable|integer',
            'monthly_rent' => 'nullable|numeric',
            'area'         => 'nullable|string',
            'owner_id'     => 'nullable|string',
            'staff_id'     => 'nullable|string',
            'branch_id'    => 'nullable|string',
        ]);

        // 2. GENERATE CUSTOM PROPERTY ID (e.g., outputs PR0001, PR0002)
        $lastProperty = \App\Models\Property::orderBy('property_id', 'desc')->first();
        
        if ($lastProperty) {
            // Strip the string prefix prefix, pull the number, and add 1
            $number = intval(substr($lastProperty->property_id, 2)) + 1;
            $nextId = 'PR' . str_pad($number, 4, '0', STR_PAD_LEFT);
        } else {
            $nextId = 'PR0001'; // Fallback for the first entry in the database table
        }

        // 3. Build array including the generated property_id string
        \App\Models\Property::create([
            'property_id'  => $nextId, // Assigning generated token string here
            'street'       => $validated['street'],
            'city'         => $validated['city'],
            'postcode'     => $validated['postcode'],
            'type'         => $validated['type'],
            'rooms'        => $validated['rooms'],
            'monthly_rent' => $validated['monthly_rent'],
            'area'         => $validated['area'],
            'owner_id'     => $validated['owner_id'],
            'staff_id'     => $validated['staff_id'],
            'branch_id'    => $validated['branch_id'],
        ]);

        return redirect()->route('properties.index')->with('success', 'Property successfully listed!');
    }

    public function edit($property_id)
    {
        $property = Property::where('property_id', $property_id)->firstOrFail();
        $owners = Owner::all();
        $branches = Branch::all();

        return view('properties.edit', compact('property', 'owners', 'branches'));
    }

    public function update(Request $request, $id)
    {
        // 1. Find the property record using the unique string ID
        $property = \App\Models\Property::where('property_id', $id)->firstOrFail();

        // 2. Validate all incoming form fields safely
        $validated = $request->validate([
            'street'       => 'required|string|max:255',
            'city'         => 'nullable|string|max:255',
            'postcode'     => 'nullable|string|max:20',
            'type'         => 'required|string',
            'status'       => 'required|string',
            'rooms'        => 'nullable|integer',
            'monthly_rent' => 'nullable|numeric',
            'area'         => 'nullable|string',
            'owner_id'     => 'nullable|string',
            'staff_id'     => 'nullable|string',
            'branch_id'    => 'nullable|string',
        ]);

        // 3. Perform the database update operation
        $property->update([
            'street'       => $validated['street'],
            'city'         => $validated['city'],
            'postcode'     => $validated['postcode'],
            'type'         => $validated['type'],
            'status'       => $validated['status'],
            'rooms'        => $validated['rooms'],
            'monthly_rent' => $validated['monthly_rent'],
            'area'         => $validated['area'],
            'owner_id'     => $validated['owner_id'],
            'staff_id'     => $validated['staff_id'],
            'branch_id'    => $validated['branch_id'],
        ]);

        // 4. Redirect back to the profile details view with a success notification banner
        return redirect()
            ->route('properties.show', $property->property_id)
            ->with('success', 'Property tracking details updated successfully!');
    }

    public function show($id)
    {
        $property = Property::with('advertisements')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    public function destroy($id)
    {
        // 1. Target the specific row using your custom string column primary key
        $property = \App\Models\Property::where('property_id', $id)->firstOrFail();

        // 2. Cascade delete or clear records if database restrictions require it
        // If you have an advertisements relationship defined, delete them first to prevent foreign key errors:
        if ($property->advertisements) {
            $property->advertisements()->delete();
        }

        // 3. Delete the property row from the table
        $property->delete();

        // 4. Send the user back to the directory list with a confirmation alert message
        return redirect()
            ->route('properties.index')
            ->with('success', 'Property records successfully removed from system databases.');
    }
    public function getStaffByBranch($branch_id): JsonResponse
    {
        // Fetch all active staff records belonging to this specific branch location
        $staffMembers = Staff::where('branch_id', $branch_id)
            ->select('staff_id', 'first_name', 'last_name', 'position')
            ->get();

        return response()->json($staffMembers);
    }
}