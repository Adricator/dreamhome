<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ViewingController;
use App\Http\Controllers\LeaseController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

// Root URL points directly to the login interface
Route::get('/', function () {
    if (Auth::check()) { // <-- Changed from auth()->check()
        return redirect()->route('dashboard');
    }
    
    return redirect()->route('login');
})->name('home');

// Search Engine Routes
Route::get('/search', [SearchController::class, 'index'])->name('search.page');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');
// Client Portal Preference Submission
Route::get('/register-preferences', function () {
    return view('client_preferences'); 
})->name('register.preferences');


/*
|--------------------------------------------------------------------------
| Secure Management Routes (Requires Admin/Staff Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Main App Dashboard Window
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Standard CRUD Resources (Scoped to use custom column parameters)
    Route::resource('branches', BranchController::class)->parameters(['branches' => 'branch_id']);
    Route::resource('staff', StaffController::class)->parameters(['staff' => 'staff_id']);
    Route::resource('properties', PropertyController::class)->parameters(['properties' => 'property_id']);
    Route::resource('owners', OwnerController::class)->parameters(['owners' => 'owner_id']);
    Route::resource('clients', ClientController::class)->parameters(['clients' => 'client_id']);
    Route::resource('inspections', InspectionController::class);

    // Contextual Composite Key Mapping for Inspections Edit Window
    Route::get('/inspections/{property_id}/{inspection_date}/edit', [InspectionController::class, 'edit'])->name('inspections.edit');

    // Read-Only System Trackers
    Route::get('/viewings', [ViewingController::class, 'index'])->name('viewings.index');
    Route::get('/leases', [LeaseController::class, 'index'])->name('leases.index');

});

/*
|--------------------------------------------------------------------------
| Laravel Breeze Authentication Handlers (Login, Registration, Logouts)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';