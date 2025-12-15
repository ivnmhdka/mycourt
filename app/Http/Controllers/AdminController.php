<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Field;
use App\Models\Booking;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalFields = Field::count();
        $totalBookings = Booking::count();

        return view('admin.dashboard', compact('totalUsers', 'totalManagers', 'totalFields', 'totalBookings'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting self (Admin) just in case
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
