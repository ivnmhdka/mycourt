<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Ambil notifikasi user yang sedang login
        $notifications = Auth::user()->notifications ?? collect();

        return view('notifications.index', compact('notifications'));
    }
}