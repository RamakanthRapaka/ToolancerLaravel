<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Expert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        /**
         * =========================================================
         * Mandatory Fix:
         * ---------------------------------------------------------
         * Define $filePath early so it exists in catch block
         * =========================================================
         */
        $filePath = null;

        DB::beginTransaction();

        try {
            /**
             * =========================================================
             * 1️⃣ Create User
             * =========================================================
             */
            $user = User::create([
                'name'         => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'email'        => $request->input('email'),
                'mobile'       => $request->input('mobile'),
                'password'     => Hash::make($request->input('password')),
            ]);

            /**
             * =========================================================
             * 2️⃣ Role Assignment (SECURITY HARDENED)
             * ---------------------------------------------------------
             * Prevent users from assigning admin role directly
             * =========================================================
             */
            $role = $request->input('role');

            if (!in_array($role, ['user', 'expert'])) {
                throw new \Exception('Invalid role assignment attempt');
            }

            $user->assignRole($role);

            /**
             * =========================================================
             * 3️⃣ Create Expert Profile (Only for expert role)
             * =========================================================
             */
            if ($role === 'expert') {

                // Handle profile upload
                if ($request->hasFile('profileFile')) {
                    $filePath = $request->file('profileFile')
                        ->store('experts', 'public');
                }

                Expert::create([
                    'user_id'        => $user->id,
                    'tags'           => $this->stringify($request->input('tags')),
                    'expertise_tags' => $this->stringify($request->input('expertiseTags')),
                    'tools_known'    => $this->stringify($request->input('toolsKnown')),
                    'skills'         => $this->stringify($request->input('skills')),
                    'location'       => $request->input('location'),
                    'languages'      => $this->stringify($request->input('languages')),
                    'rate'           => $request->input('rate'),
                    'portfolio_url'  => $request->input('portfolioURL'),
                    'short_bio'      => $request->input('shortBio'),
                    'profile_bio'    => $request->input('profileBio'),
                    'profile_file'   => $filePath,
                ]);
            }

            /**
             * =========================================================
             * ✅ Commit Transaction
             * =========================================================
             */
            DB::commit();

            // AJAX-safe response
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Registration successful',
                ], 201);
            }

            return redirect()->back()->with('success', 'Registration successful');

        } catch (\Throwable $e) {

            /**
             * =========================================================
             * ❌ Rollback Everything
             * =========================================================
             */
            DB::rollBack();

            /**
             * Cleanup uploaded file if DB failed
             */
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            /**
             * Log error for debugging
             */
            Log::error('Registration failed', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            // AJAX error response
            if ($request->expectsJson()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Registration failed. Please try again.',
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    /**
     * =========================================================
     * Helper: Convert array input to comma-separated string
     * Prevents "Array to string conversion" errors
     * =========================================================
     */
    private function stringify($value): ?string
    {
        if (is_array($value)) {
            return implode(',', $value);
        }

        return $value;
    }
}
