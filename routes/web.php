<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// Admin
Route::get('/admin/dashboard', function () {
    return 'Admin Dashboard';
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);

// Expert
Route::get('/expert/dashboard', function () {
    return 'Expert Dashboard';
})->name('expert.dashboard')->middleware(['auth', 'role:expert']);

// User
Route::get('/user/dashboard', function () {
    return 'User Dashboard';
})->name('user.dashboard')->middleware(['auth', 'role:user']);
