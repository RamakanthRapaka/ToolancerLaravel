<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile page (same page for view + update)
     */
    public function show()
    {
        $user = auth()->user();

        return view('profile.profile', [
            'user'   => $user,
            'expert' => $user->expert ?? null,
        ]);
    }

    /**
     * Update profile (AJAX + normal submit)
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $filePath = null;

        DB::beginTransaction();

        try {

            /* ===============================
             * Update USER table
             * =============================== */
            $user->update([
                'display_name' => $request->display_name,
                'email'        => $request->email,
                'mobile'       => $request->mobile,
            ]);

            /* ===============================
             * Update EXPERT table (if expert)
             * =============================== */
            if ($user->hasRole('expert') && $user->expert) {

                $expert = $user->expert;

                // Profile image upload
                if ($request->hasFile('profile_image')) {

                    if ($expert->profile_file) {
                        Storage::disk('public')->delete($expert->profile_file);
                    }

                    $filePath = $request->file('profile_image')
                        ->store('experts', 'public');
                }

                $expertData = [
                    'tags'           => $this->stringify($request->input('tags')),
                    'expertise_tags' => $this->stringify($request->input('expertise_tags')),
                    'tools_known'    => $this->stringify($request->input('tools_known')),
                    'skills'         => $this->stringify($request->input('skills')),
                    'location'       => $request->input('location'),
                    'languages'      => $this->stringify($request->input('languages')),
                    'rate'           => $request->input('rate'),
                    'portfolio_url'  => $request->input('portfolio_url'),
                    'short_bio'      => $request->input('short_bio'),
                    'profile_bio'    => $request->input('profile_bio'),
                ];

                if ($filePath) {
                    $expertData['profile_file'] = $filePath;
                }

                $expert->update($expertData);
            }

            DB::commit();

            /* ===============================
             * AJAX response
             * =============================== */
            if ($request->ajax()) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Profile updated successfully',
                ]);
            }

            return redirect()
                ->route('profile.show')
                ->with('success', 'Profile updated successfully');

        } catch (\Throwable $e) {

            DB::rollBack();

            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }

            if ($request->ajax()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Profile update failed',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Profile update failed']);
        }
    }

    /**
     * Convert array to comma-separated string
     */
    private function stringify($value): ?string
    {
        if (is_array($value)) {
            return implode(',', $value);
        }

        return $value;
    }
}
