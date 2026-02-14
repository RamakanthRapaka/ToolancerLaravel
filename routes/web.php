<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolGridController;
use App\Http\Controllers\ToolUploadController;
use App\Http\Controllers\UserGridController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/expert-tools', [HomeController::class, 'tools'])
    ->name('expert.tools');
Route::get('/expert-users', [HomeController::class, 'experts'])
    ->name('expert.users');
Route::get('/expert-tools/ajax', [HomeController::class, 'ajax'])
    ->name('expert.tools.ajax');
Route::get('/expert-users/ajax', [HomeController::class, 'expertsAjax'])
    ->name('expert.users.ajax');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.submit')
    ->middleware('guest');

/* Forgot Password */

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

/* Reset Password */

Route::get('reset-password/{token}',
    [ResetPasswordController::class, 'showResetForm']
)->name('password.reset');

Route::post('reset-password',
    [ResetPasswordController::class, 'reset']
)->name('password.update');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/tool-upload', [ToolUploadController::class, 'index'])
        ->name('toolupload.index');

    Route::post('/tool-upload', [ToolUploadController::class, 'store'])
        ->name('toolupload.store');

    Route::post(
        '/tool/{tool}/status',
        [ToolGridController::class, 'updateStatus']
    )->name('tool.updateStatus')
        ->middleware(['auth', 'role:admin']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/categories', [ToolGridController::class, 'index'])
        ->name('toolgrid.index');

    Route::get('/tools/grid/data', [ToolGridController::class, 'data'])
        ->name('tools.grid.data');

    Route::get('/tools/{tool}', [ToolGridController::class, 'show'])->name('tools.show');
    Route::get('/tools/{tool}/edit', [ToolGridController::class, 'edit'])->name('tools.edit');

    Route::get('/users', [UserGridController::class, 'index'])->name('users.index');
    Route::get('/users/data', [UserGridController::class, 'data'])->name('users.grid.data');

    Route::get('/users/{user}', [UserGridController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserGridController::class, 'edit'])->name('users.edit');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
