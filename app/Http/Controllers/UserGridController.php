<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGridController extends Controller
{
    public function index()
    {
        return view('usergrid.index');
    }

    public function data()
    {
        $users = User::with('roles')->latest()->get();

        return response()->json([
            'data' => $users->map(function ($user) {

                $role = $user->roles->pluck('name')->implode(', ') ?: 'User';

                return [
                    'id' => $user->id,
                    'name' => e($user->name),
                    'email' => e($user->email),
                    'role' => ucfirst($role),
                    'status' => $user->email_verified_at
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>',
                    'actions' => view(
                        'usergrid.partials.actions',
                        compact('user')
                    )->render()
                ];
            })
        ]);
    }
}
