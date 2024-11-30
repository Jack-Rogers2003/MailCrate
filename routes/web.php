<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Dashboard;

use Illuminate\Support\Facades\Route;

Route::get('/', [Dashboard::class, 'render', '']);
Route::get('/auth', [AuthController::class, 'showAuthForm']);
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

