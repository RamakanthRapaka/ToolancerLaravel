<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login page
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // ✅ Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // ✅ Attempt login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();
            $user = Auth::user();

            // 🔐 Role-based redirect
            if ($user->hasRole('admin')) {
                $redirect = route('admin.dashboard');
            } elseif ($user->hasRole('expert')) {
                $redirect = route('expert.dashboard');
            } else {
                $redirect = route('user.dashboard');
            }

            // ✅ AJAX response
            if ($request->expectsJson()) {
                return response()->json([
                    'status'   => true,
                    'redirect' => $redirect,
                ]);
            }

            return redirect()->intended($redirect);
        }

        // ❌ Login failed
        if ($request->expectsJson()) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid email or password',
            ], 422);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
