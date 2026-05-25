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
use App\Http\Controllers\Auth\ClientAuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
| These routes can be accessed without logging in.
|--------------------------------------------------------------------------
*/

// Welcome / landing page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Search page
Route::get('/search', [SearchController::class, 'index'])
    ->name('search.page');

// Search results
Route::get('/search/results', [SearchController::class, 'search'])
    ->name('search.results');

// Client preference registration page
Route::get('/register-preferences', function () {
    return view('client_preferences');
})->name('register.preferences');


/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
| Only authenticated users with admin or staff role can access this page.
|--------------------------------------------------------------------------
*/

Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin,staff'])
  ->name('dashboard');

Route::post('client/logout', [ClientAuthenticatedSessionController::class, 'destroy'])
->name('client.logout');

/*
|--------------------------------------------------------------------------
| Protected Management Routes
|--------------------------------------------------------------------------
| These routes require the user to be logged in.
| Used for admin/staff CRUD management.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Main CRUD Resources
    |--------------------------------------------------------------------------
    | These routes handle Create, Read, Update, and Delete operations.
    | Custom parameters are used because your database uses IDs like:
    | property_id, branch_id, staff_id, owner_id, client_id.
    |--------------------------------------------------------------------------
    */

    Route::resource('properties', PropertyController::class)
        ->parameters(['properties' => 'property_id']);

    Route::resource('branches', BranchController::class)
        ->parameters(['branches' => 'branch_id']);

    Route::resource('staff', StaffController::class)
        ->parameters(['staff' => 'staff_id']);

    Route::resource('owners', OwnerController::class)
        ->parameters(['owners' => 'owner_id']);

    Route::resource('clients', ClientController::class)
        ->parameters(['clients' => 'client_id']);

    Route::resource('inspections', InspectionController::class);
        
    Route::resource('viewings', ViewingController::class);


   

    Route::resource('leases', LeaseController::class)
        ->only(['index']);

    Route::get('/api/branches/{branch_id}/supervisors', [StaffController::class, 'getSupervisorsByBranch']);
    Route::get('/api/branches/{branch_id}/staff', [PropertyController::class, 'getStaffByBranch']);

});

require __DIR__ . '/auth.php';