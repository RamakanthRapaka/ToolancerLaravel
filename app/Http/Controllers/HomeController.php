<?php

namespace App\Http\Controllers;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Latest ACTIVE tools
        $tools = Tool::with(['category'])
            //->where('tool_status_id', 2) // active
            ->latest()
            ->limit(8)
            ->get();

        // Featured experts
        $experts = User::with('expert')
            ->whereHas('roles', fn($q) => $q->where('name', 'expert'))
            ->latest()
            ->limit(4)
            ->get();

        return view('home', compact('tools', 'experts'));
    }
}
