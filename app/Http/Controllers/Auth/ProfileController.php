<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile (view-only mode)
     */
    public function show()
    {
        $user = auth()->user();

        return view('profile.profile', [
            'user' => $user,
            'expert' => $user->expert ?? null,
        ]);
    }

    /**
     * Update profile (supports AJAX + normal submit)
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $filePath = null;

        DB::beginTransaction();

        try {

            /**
             * -------------------------
             * Update User table
             * -------------------------
             */
            $user->update(
                $request->only([
                    'name',
                    'display_name',
                    'email',
                    'mobile',
                ])
            );

            /**
             * -------------------------
             * Update Expert profile (only if expert)
             * -------------------------
             */
            if ($user->hasRole('expert') && $user->expert) {

                $expert = $user->expert;

                // Handle profile image replacement
                if ($request->hasFile('profile_image')) {

                    if ($expert->profile_file) {
                        Storage::disk('public')->delete($expert->profile_file);
                    }

                    $filePath = $request->file('profile_image')
                        ->store('experts', 'public');
                }

                $expertData = [
                    'tags' => $this->stringify($request->input('tags')),
                    'expertise_tags' => $this->stringify($request->input('expertiseTags')),
                    'tools_known' => $this->stringify($request->input('toolsKnown')),
                    'skills' => $this->stringify($request->input('skills')),
                    'location' => $request->input('location'),
                    'languages' => $this->stringify($request->input('languages')),
                    'rate' => $request->input('rate'),
                    'portfolio_url' => $request->input('portfolioURL'),
                    'short_bio' => $request->input('shortBio'),
                    'profile_bio' => $request->input('profileBio'),
                ];

                if ($filePath) {
                    $expertData['profile_file'] = $filePath;
                }

                $expert->update($expertData);
            }

            DB::commit();

            // AJAX response
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Profile updated successfully',
                ]);
            }

            return redirect()
                ->route('profile.show')
                ->with('success', 'Profile updated successfully');

        } catch (\Throwable $e) {

            DB::rollBack();

            // cleanup uploaded file if DB failed
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Profile update failed',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Profile update failed']);
        }
    }

    /**
     * Helper: convert array inputs to comma-separated string
     */
    private function stringify($value): ?string
    {
        if (is_array($value)) {
            return implode(',', $value);
        }

        return $value;
    }
}
