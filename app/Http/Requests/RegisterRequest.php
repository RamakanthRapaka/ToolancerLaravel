<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Allow everyone to make this request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'mobile'   => 'required|string|max:15',
            'role'     => 'required|in:user,expert',
        ];

        // Expert-only validation
        if ($this->input('role') === 'expert') {
            $rules = array_merge($rules, [
                'tags'           => 'required|string|max:255',
                'expertiseTags'  => 'required|string|max:255',
                'toolsKnown'     => 'required|string|max:255',
                'skills'         => 'required|string|max:255',
                'location'       => 'required|string|max:255',
                'languages'      => 'required|string|max:255',
                'rate'           => 'required|string|max:100',
                'portfolioURL'   => 'nullable|url',
                'shortBio'       => 'required|string|max:500',
                'profileBio'     => 'required|string|max:2000',
                'profileFile'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
        }

        return $rules;
    }

    /**
     * Custom error messages (optional)
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered.',
            'password.confirmed' => 'Passwords do not match.',
            'profileFile.mimes' => 'Profile file must be an image or PDF.',
        ];
    }
}
