<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingHistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;

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
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.index');
    })->name('dashboard');

    Route::get('/fields', [UserBookingController::class, 'index'])->name('fields.index');
    Route::get('/booking/{id}', [UserBookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{id}', [UserBookingController::class, 'show'])->name('booking.show');
    Route::post('/booking', [UserBookingController::class, 'store'])->name('booking.store');
    
    // Payment Flow
    Route::get('/booking/{id}/payment', [UserBookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/{id}/pay', [UserBookingController::class, 'confirmPayment'])->name('booking.pay');
    Route::get('/booking/{id}/success', [UserBookingController::class, 'success'])->name('booking.success');

    Route::get('/riwayat-booking', [BookingHistoryController::class, 'index'])->name('booking.history');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications.index');
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

        Route::get('/schedule', function () {
            return view('manager.schedule');
        })->name('schedule');
        
Route::get('/laporan/pendapatan/pdf', [ManagerController::class, 'laporanPendapatanPdf'])
    ->name('laporan.pendapatan.pdf');

Route::get('/laporan/pendapatan/excel', [ManagerController::class, 'laporanPendapatanExcel'])
    ->name('laporan.pendapatan.excel');

    });


// ==============================
// Admin Routes
// ==============================
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
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