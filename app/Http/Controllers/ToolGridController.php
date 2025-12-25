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

                $statusBadge = match ($tool->status) {
                    'active' => '<span class="badge bg-success">Active</span>',
                    'rejected' => '<span class="badge bg-danger">Rejected</span>',
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
                    'actions' => view('toolgrid.partials.actions', ['tool' => $tool, 'user' => Auth::user()])->render()
                ];
            })
        ]);
    }

}
