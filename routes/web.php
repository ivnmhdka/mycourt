<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Placeholder for field listing and details (Public or User?)
// Assuming public for viewing, auth for booking
Route::get('/fields', function () {
    return view('user.fields'); // Placeholder
});

// User (Penyewa) Routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.index'); 
    })->name('dashboard');

    Route::get('/fields', [App\Http\Controllers\UserBookingController::class, 'index'])->name('fields.index');
    Route::get('/booking/{id}', [App\Http\Controllers\UserBookingController::class, 'show'])->name('booking.show');
    Route::post('/booking', [App\Http\Controllers\UserBookingController::class, 'store'])->name('booking.store');
});

// Manager Routes
Route::middleware(['auth', 'verified', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\ManagerController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [App\Http\Controllers\ManagerController::class, 'index'])->name('bookings');
    Route::post('/bookings/{id}/status', [App\Http\Controllers\ManagerController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/schedule', function () {
        return view('manager.schedule');
    })->name('schedule');
});

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
