<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToolUploadRequest extends FormRequest
{
    /**
     * Allow authenticated users only
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            'tool_name' => 'required|string|min:3|max:255',

            'tool_category_id' => 'required|exists:tool_categories,id',
            'sub_category_id' => 'required|exists:tool_sub_categories,id',

            'affiliate_link' => 'nullable|url|max:500',

            'pricing_type_id' => 'required|exists:pricing_types,id',
            'pricing_details_id' => 'required_if:pricing_type_id,!=,1|exists:pricing_details,id',

            'tool_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tool_video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',

            'tool_video_link' => 'nullable|url|max:500',

            'tags' => 'nullable|string|max:255',
            'official_reviews_url' => 'nullable|url|max:500',
            'comparison_group' => 'nullable|string|max:100',

            'rating' => 'nullable|numeric|min:0|max:5',

            'use_cases' => 'required|string|max:1000',
            'features' => 'required|string|max:1000',

            'short_description' => 'required|string|max:500',
            'full_description' => 'required|string',
        ];
    }

    /**
     * Custom messages (optional but recommended)
     */
    public function messages(): array
    {
        return [
            'tool_name.required' => 'Tool name is required',
            'tool_category_id.required' => 'Please select a tool category',
            'sub_category_id.required' => 'Please select a sub category',
            'pricing_type_id.required' => 'Please select pricing type',
            'pricing_details_id.required' => 'Please select pricing details',
            'tool_status_id.required' => 'Please select tool status',
            'tool_logo.image' => 'Tool logo must be an image file',
            'rating.max' => 'Rating must be between 0 and 5',
            'use_cases.required' => 'Please enter use cases',
            'features.required' => 'Please enter features',
        ];
    }
}
