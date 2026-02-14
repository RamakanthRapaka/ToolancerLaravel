<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Only authenticated users can update profile
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
        $userId = auth()->id();
        $isExpert = auth()->user()?->hasRole('expert');

        return [

            /**
             * -----------------------
             * User fields
             * -----------------------
             */
            'name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'display_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            /**
             * -----------------------
             * Expert-only fields
             * -----------------------
             */
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            // ✅ FIXED
            'tags' => $isExpert
                ? ['required', 'array', 'min:1']
                : ['nullable', 'array'],

            // ✅ FIXED
            'tags.*' => [
                'string',
                'max:100',
            ],

            'expertise_tags' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tools_known' => [
                'nullable',
                'string',
                'max:255',
            ],

            'skills' => [
                'nullable',
                'string',
                'max:255',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'languages' => [
                'nullable',
                'string',
                'max:255',
            ],

            'rate' => [
                'nullable',
                'string',
                'max:100',
            ],

            'portfolio_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'short_bio' => [
                'nullable',
                'string',
                'max:500',
            ],

            'profile_bio' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'This email is already in use',

            'tags.required' => 'Please select at least one tag',
            'tags.min' => 'Please select at least one tag',

            'profile_image.image' => 'Profile image must be an image file',
            'profile_image.max' => 'Profile image must be less than 2MB',

            'portfolio_url.url' => 'Portfolio URL must be a valid URL',
        ];
    }
}
