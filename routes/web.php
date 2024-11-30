<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'showDashboard', '']);
Route::get('/auth', [AuthController::class, 'showAuthForm']);
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

