<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expert;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tools'     => 100, // replace with real query later
            'total_users'     => User::count(),
            'total_active'    => User::whereNotNull('email_verified_at')->count(),
            'total_rejected'  => 0,
        ];

        return view('dashboard.index', compact('stats'));
    }
}
