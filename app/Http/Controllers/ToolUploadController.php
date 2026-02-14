<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolUploadRequest;
use App\Imports\ToolsImport;
use App\Models\PricingDetail;
use App\Models\PricingType;
use App\Models\Tool;
use App\Models\ToolCategory;
use App\Models\ToolStatus;
use App\Models\ToolSubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            'message' => 'Tool uploaded successfully 🎉',
        ]);
    }

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // max 10MB
        ]);

        try {
            $import = new ToolsImport;
            Excel::import($import, $request->file('excel_file'));

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Tools uploaded successfully via Excel!',
                ]);
            }

            return redirect()->back()->with('success', 'Tools uploaded successfully via Excel!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $errorMessages[] = "Row {$failure->row()}: ".implode(', ', $failure->errors());
            }

            $message = 'Excel validation failed: '.implode(' | ', $errorMessages);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ], 422);
            }

            return redirect()->back()->with('error', $message);

        } catch (\Exception $e) {
            Log::error('Excel import error: '.$e->getMessage());

            $message = 'Error uploading Excel: '.$e->getMessage();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => $message,
                ], 500);
            }

            return redirect()->back()->with('error', $message);
        }
    }
}
