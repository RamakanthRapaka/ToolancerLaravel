<?php

namespace App\Http\Controllers;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ToolCategory;

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

    public function tools()
    {
        $categories = ToolCategory::where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view('tools.all', compact('categories'));
    }

    /**
     * Show all experts
     */
    public function experts()
    {
        $experts = User::with('expert')
            ->whereHas('roles', fn($q) => $q->where('name', 'expert'))
            ->get();

        return view('experts.index', compact('experts'));
    }
    public function ajax(Request $request)
    {
        $query = Tool::with(['category', 'pricingType'])
            ->where('tool_status_id', 1);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('tool_name', 'like', '%' . $request->search . '%');
        }

        // 🧩 Category filter
        if ($request->category && $request->category !== 'all') {
            $query->where('tool_category_id', $request->category);
        }

        $tools = $query->latest()->get();

        return response()->json([
            'html' => view('tools.partials.cards', compact('tools'))->render()
        ]);
    }

}
