<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Expert;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        // User creation
        $user = User::create([
            'name'         => $request->input('name'),
            'display_name' => $request->input('displayName'),
            'email'        => $request->input('email'),
            'mobile'       => $request->input('mobile'),
            'password'     => Hash::make($request->input('password')),
        ]);

        // Assign role via Spatie
        $user->assignRole($request->input('role'));

        // Expert profile creation
        if ($request->input('role') === 'expert') {

            $filePath = null;
            if ($request->hasFile('profileFile')) {
                $filePath = $request->file('profileFile')
                                   ->store('experts', 'public');
            }

            Expert::create([
                'user_id'        => $user->id,
                'tags'           => $request->input('tags'),
                'expertise_tags' => $request->input('expertiseTags'),
                'tools_known'    => $request->input('toolsKnown'),
                'skills'         => $request->input('skills'),
                'location'       => $request->input('location'),
                'languages'      => $request->input('languages'),
                'rate'           => $request->input('rate'),
                'portfolio_url'  => $request->input('portfolioURL'),
                'short_bio'      => $request->input('shortBio'),
                'profile_bio'    => $request->input('profileBio'),
                'profile_file'   => $filePath,
            ]);
        }

        return redirect()->back()->with('success', 'Registration successful');
    }
}
