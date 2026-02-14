<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToolGridController extends Controller
{
    public function index()
    {
        return view('toolgrid.index');
    }

    public function data(Request $request)
    {
        $tools = Tool::with(['category', 'subCategory', 'pricingType', 'pricingDetail'])
            ->latest()
            ->get();

        return response()->json([
            'data' => $tools->map(function ($tool) {

                $statusBadge = match ($tool->tool_status_id) {
                    2 => '<span class="badge bg-success">Active</span>',
                    3 => '<span class="badge bg-danger">Rejected</span>',
                    default => '<span class="badge bg-warning text-dark">Pending</span>',
                };

                return [
                    'id' => $tool->id,
                    'tool_name' => e($tool->tool_name),
                    'category' => $tool->category->name ?? '-',
                    'sub_category' => $tool->subCategory->name ?? '-',
                    'pricing_type' => $tool->pricingType->name ?? '-',
                    'pricing_detail' => $tool->pricingDetail->label ?? '-',
                    'status' => $statusBadge,
                    'affiliate_link' => $tool->affiliate_link,
                    'tags' => $tool->tags,
                    'actions' => view('toolgrid.partials.actions', ['tool' => $tool, 'user' => Auth::user()])->render(),
                ];
            }),
        ]);
    }

    public function updateStatus(Request $request, Tool $tool)
    {
        // 🔒 Restrict to admin only
    if (!Auth::user()->hasRole('admin')) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized action'
        ], 403);
    }

        $request->validate([
            'status' => 'required|in:active,pending,rejected',
        ]);

        // ✅ TEXT → NUMBER mapping
        $statusMap = [
            'active' => 2,
            'pending' => 1,
            'rejected' => 3,
        ];

        $tool->update([
            'tool_status_id' => $statusMap[$request->input('status')],
        ]);

        // AJAX response
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Tool status updated successfully',
            ]);
        }

        return back()->with('success', 'Tool status updated');
    }
}
