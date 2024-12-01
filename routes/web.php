<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilePageController;

use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'showDashboard', '']);
Route::get('/auth', [AuthController::class, 'showAuthForm']);
Route::get('/profile/{userID}', [ProfilePageController::class, 'showProfile'])->name('profile');
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

