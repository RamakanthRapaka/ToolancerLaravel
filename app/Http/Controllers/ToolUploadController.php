<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToolCategory;
use App\Models\ToolSubCategory;
use App\Models\PricingType;
use App\Models\PricingDetail;
use App\Models\ToolStatus;
use App\Http\Requests\ToolUploadRequest;
use App\Models\Tool;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class ToolUploadController extends Controller
{
    public function index()
    {

        return view('toolupload.index', [
            'categories' => ToolCategory::all(),
            'subCategories' => ToolSubCategory::all(),
            'pricingTypes' => PricingType::all(),
            'pricingDetails' => PricingDetail::all(),
            'toolStatuses' => ToolStatus::all(),
        ]);
    }

    public function store(ToolUploadRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['tool_sub_category_id'] = $data['sub_category_id'];
        unset($data['sub_category_id']);

        $data['pricing_detail_id'] = $data['pricing_details_id'];
        unset($data['pricing_details_id']);

        $data['demo_video_link'] = $data['tool_video_link'];
        unset($data['tool_video_link']);

        // Logo upload
        if ($request->hasFile('tool_logo')) {
            $data['logo'] = $request->file('tool_logo')
                ->store('tools/logos', 'public');
        }

        // Video upload
        if ($request->hasFile('tool_video')) {
            $data['demo_video'] = $request->file('tool_video')
                ->store('tools/videos', 'public');
        }

        $data['user_id'] = auth()->id();

        Tool::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Tool uploaded successfully 🎉'
        ]);
    }
}

