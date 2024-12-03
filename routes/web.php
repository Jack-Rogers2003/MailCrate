<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\PostEdit;


use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'showDashboard', '']);
Route::get('/auth', [AuthController::class, 'showAuthForm']);
Route::get('/profile/{userID}', [ProfilePageController::class, 'showProfile'])->name('profile');
Route::get('post/edit/{postID}', [PostEdit::class, 'showPostToEdit'])->name('edit_post');
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

