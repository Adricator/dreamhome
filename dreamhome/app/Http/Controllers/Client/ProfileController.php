<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('client.profile.edit');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\Client $client */ // <--- Add this line
        $client = Auth::guard('client')->user();

        $validated = $request->validate([
            // ... your validation
        ]);

        // Now Intelephense knows $client is an Eloquent model
        $client->update($request->except(['password']));

        if ($request->filled('password')) {
            $client->password = Hash::make($request->password);
            $client->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}