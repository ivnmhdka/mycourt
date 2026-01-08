<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\FieldController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Public access to field listing (non-authenticated users)
Route::get('/fields', function () {
    return view('user.fields'); // Placeholder
});

// ==============================
// User (Penyewa) Routes
// ==============================
// ==============================
// Dashboard Redirection (General)
// ==============================
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = Illuminate\Support\Facades\Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'manager') {
        return redirect()->route('manager.dashboard');
    }

    // Default: User Dashboard
    return view('user.index');
})->name('dashboard');


// ==============================
// User (Penyewa) Routes
// ==============================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('user.index');
    // })->name('dashboard');

    Route::get('/fields', [UserBookingController::class, 'index'])->name('fields.index');
    Route::get('/booking/{id}', [UserBookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}', [UserBookingController::class, 'show'])->name('booking.show');
    Route::post('/booking', [UserBookingController::class, 'store'])->name('booking.store');
    
    // Payment Flow
    Route::get('/booking/{id}/payment', [UserBookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/{id}/pay', [UserBookingController::class, 'confirmPayment'])->name('booking.pay');
    Route::get('/booking/{id}/success', [UserBookingController::class, 'success'])->name('booking.success');

    Route::get('/riwayat-booking', [BookingHistoryController::class, 'index'])->name('booking.history');
});

// ==============================
// Manager Routes
// ==============================
Route::middleware(['auth', 'verified', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [ManagerController::class, 'index'])->name('bookings');
        Route::post('/bookings/{id}/status', [ManagerController::class, 'updateStatus'])->name('bookings.updateStatus');

        Route::get('/schedule', [ManagerController::class, 'schedule'])->name('schedule');
        Route::post('/schedule', [ManagerController::class, 'updateSchedule'])->name('schedule.update');

        Route::get('/laporan/pendapatan/pdf', [ManagerController::class, 'laporanPendapatanPdf'])
            ->name('laporan.pendapatan.pdf');

        Route::get('/laporan/pendapatan/excel', [ManagerController::class, 'laporanPendapatanExcel'])
            ->name('laporan.pendapatan.excel');
    });


// ==============================
// Admin Routes
// ==============================
//Route::middleware(['auth', 'verified', 'role:admin'])
//    ->prefix('admin')
//    ->name('admin.')
//    ->group(function () {
//        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
//        Route::get('/users', [AdminController::class, 'users'])->name('users');
//        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
//        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
//        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
//        Route::patch('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
//        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
//    });
//
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::patch('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

        // ✅ INI YANG KURANG SELAMA INI
        Route::resource('fields', \App\Http\Controllers\Admin\FieldController::class);
        // Route::resource('fields', FieldController::class);
    });


// ==============================
// Profile Routes (for All Roles)
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes from Laravel Breeze/Fortify/etc
require __DIR__ . '/auth.php';