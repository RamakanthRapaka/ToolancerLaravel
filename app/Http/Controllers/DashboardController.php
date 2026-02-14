<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tools' => 100, // replace with real query later
            'total_users' => User::count(),
            'total_active' => User::whereNotNull('email_verified_at')->count(),
            'total_rejected' => 0,
        ];

        return view('dashboard.index', compact('stats'));
    }
}
