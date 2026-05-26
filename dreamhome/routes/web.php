<?php

use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\Auth\ClientAuthenticatedSessionController;
use App\Http\Controllers\Client\ClientPropertyController;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page
Route::get('/', function () {
    $properties = Property::all(); 
    return view('welcome', compact('properties'));
})->name('welcome');

// 2. Properties Section Anchor
Route::get('/properties', function () {
    return view('welcome');
})->name('properties.section');

// 3. The Gateway Selection Screen
Route::get('/portal-select', function () {
    return view('auth.gateway'); 
})->name('portal.select');

// 4. Search System
Route::get('/search', [SearchController::class, 'index'])->name('search.page');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');

// 5. Client Preference Registration Page
Route::get('/register-preferences', function () {
    return view('client_preferences');
})->name('register.preferences');


/*
|--------------------------------------------------------------------------
| Auth Scaffolding Alignment
|--------------------------------------------------------------------------
*/

// Staff & Admin Login Page Processing
Route::get('/staff-login', function () {
    return view('auth.staff-login'); 
})->name('login');

Route::post('/staff-login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

// Global Redirect Fallback
Route::get('/login-redirect', function() {
    return redirect()->route('portal.select');
});


/*
|--------------------------------------------------------------------------
| Client Portal Routes (Authenticated / Prefixed)
|--------------------------------------------------------------------------
*/
Route::prefix('client')->name('client.')->group(function () {
    
    // Core Dashboard Layout
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->name('dashboard');

    // Property Catalog Browsing Sub-module
    Route::get('/properties', [ClientPropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property_id}', [ClientPropertyController::class, 'show'])->name('properties.show');

    // Profile Management System Actions
    Route::get('/profile/edit', [App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\Client\ProfileController::class, 'update'])->name('profile.update');

    // Logout Terminal Call
    Route::post('/logout', [ClientAuthenticatedSessionController::class, 'destroy'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| Admin & Staff Protected Management Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin,staff'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Main CRUD Resources
    |--------------------------------------------------------------------------
    | Standard singular primary key models handle Route::resource smoothly.
    */
    Route::resource('properties', PropertyController::class)->parameters(['properties' => 'property_id']);
    Route::resource('branches', BranchController::class)->parameters(['branches' => 'branch_id']);
    Route::resource('staff', StaffController::class)->parameters(['staff' => 'staff_id']);
    Route::resource('owners', OwnerController::class)->parameters(['owners' => 'owner_id']);
    Route::resource('clients', ClientController::class)->parameters(['clients' => 'client_id']);
    Route::resource('inspections', InspectionController::class)->parameters(['inspections' => 'inspection_id']);
            
    /*
    |--------------------------------------------------------------------------
    | Composite Key Fix: Viewings Resource Splitting
    |--------------------------------------------------------------------------
    | Non-parameter routes remain clean, while individual record routes 
    | explicitly outline separate URL token keys.
    */
    Route::get('/viewings', [ViewingController::class, 'index'])->name('viewings.index');
    Route::get('/viewings/create', [ViewingController::class, 'create'])->name('viewings.create');
    Route::post('/viewings', [ViewingController::class, 'store'])->name('viewings.store');
    
    // Multi-parameter explicit identifiers
    Route::get('/viewings/{client_id}/{property_id}/{view_date}', [ViewingController::class, 'show'])->name('viewings.show');
    Route::get('/viewings/{client_id}/{property_id}/{view_date}/edit', [ViewingController::class, 'edit'])->name('viewings.edit');
    Route::put('/viewings/{client_id}/{property_id}/{view_date}', [ViewingController::class, 'update'])->name('viewings.update');
    Route::delete('/viewings/{client_id}/{property_id}/{view_date}', [ViewingController::class, 'destroy'])->name('viewings.destroy');

    /*
    |--------------------------------------------------------------------------
    | Composite Key Fix: Leases Resource Splitting
    |--------------------------------------------------------------------------
    */
    Route::get('/leases', [LeaseController::class, 'index'])->name('leases.index');
    Route::get('/leases/create', [LeaseController::class, 'create'])->name('leases.create');
    Route::post('/leases', [LeaseController::class, 'store'])->name('leases.store');
    
    // Multi-parameter explicit identifiers
    Route::get('/leases/{client_id}/{property_id}/{lease_start_date}', [LeaseController::class, 'show'])->name('leases.show');
    Route::get('/leases/{client_id}/{property_id}/{lease_start_date}/edit', [LeaseController::class, 'edit'])->name('leases.edit');
    Route::put('/leases/{client_id}/{property_id}/{lease_start_date}', [LeaseController::class, 'update'])->name('leases.update');
    Route::delete('/leases/{client_id}/{property_id}/{lease_start_date}', [LeaseController::class, 'destroy'])->name('leases.destroy');

    /*
    |--------------------------------------------------------------------------
    | Internal API Select Triggers
    |--------------------------------------------------------------------------
    */
    Route::get('/api/branches/{branch_id}/supervisors', [StaffController::class, 'getSupervisorsByBranch']);
    Route::get('/api/branches/{branch_id}/staff', [PropertyController::class, 'getStaffByBranch']);

});

// Standard Authentication Scaffolding Import
require __DIR__ . '/auth.php';