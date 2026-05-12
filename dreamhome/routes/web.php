<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SearchController;


// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');
// Public viewing for the property list, search, and filter
Route::resource('branches', BranchController::class);
Route::resource('staff', StaffController::class);
Route::resource('properties', PropertyController::class);
Route::resource('owners', OwnerController::class);
Route::resource('clients', ClientController::class);


// Route to view a specific property and its advertisements
Route::get('/properties/{property_id}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/branches/{branch_id}', [BranchController::class, 'show'])->name('branches.show');
Route::get('/staff/{staff_id}', [StaffController::class, 'show'])->name('staff.show');
Route::get('/owners/{owner_id}', [OwnerController::class, 'show'])->name('owners.show');
Route::get('/clients/{client_id}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');








// Restricted routes for staff/admin
Route::middleware(['auth'])->group(function () {
    Route::delete('/properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});



// Add these (or your actual logic)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


// 3. Client Registration / Preferences
// Pointing to a custom registration form for client preferences
Route::get('/register-preferences', function () {
    return view('client_preferences'); 
})->name('register.preferences');

// 4. Dream Home Entity Routes
// These routes handle the various tables in your property management system
Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/inspections', [InspectionController::class, 'index'])->name('inspections.index');
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/viewings', [ViewingController::class, 'index'])->name('viewings.index');
Route::get('/leases', [LeaseController::class, 'index'])->name('leases.index');
Route::get('/search', [SearchController::class, 'index'])->name('search.page');
