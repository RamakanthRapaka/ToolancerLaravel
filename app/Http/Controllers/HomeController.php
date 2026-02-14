<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\ToolCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Latest ACTIVE tools
        $tools = Tool::with(['category'])
            // ->where('tool_status_id', 2) // active
            ->latest()
            ->limit(8)
            ->get();

        // Featured experts
        $experts = User::with('expert')
            ->whereHas('roles', fn ($q) => $q->where('name', 'expert'))
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
        return view('experts.index');
    }

    public function ajax(Request $request)
    {
        $query = Tool::with(['category', 'pricingType'])
            ->where('tool_status_id', 1);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('tool_name', 'like', '%'.$request->search.'%');
        }

        // 🧩 Category filter
        if ($request->category && $request->category !== 'all') {
            $query->where('tool_category_id', $request->category);
        }

        $tools = $query->latest()->get();

        return response()->json([
            'html' => view('tools.partials.cards', compact('tools'))->render(),
        ]);
    }

    public function expertsAjax(Request $request)
    {
        $query = User::with('expert')
            ->whereHas('roles', fn ($q) => $q->where('name', 'expert'));

        // 🔍 Search (name or skills)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhereHas('expert', function ($e) use ($request) {
                        $e->where('skills', 'like', '%'.$request->search.'%');
                    });
            });
        }

        $experts = $query->latest()->get();

        return response()->json([
            'html' => view('experts.partials.cards', compact('experts'))->render(),
        ]);
    }
}
