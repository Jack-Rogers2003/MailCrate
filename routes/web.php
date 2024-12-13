<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\PostEdit;
use App\Http\Controllers\ViewPost;
use App\Http\Controllers\EditCommentController;



use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'showDashboard', '']);
Route::get('/auth', [AuthController::class, 'showAuthForm']);
Route::get('/profile/{userID}', [ProfilePageController::class, 'showProfile'])->name('profile');
Route::get('post/edit/{postID}', [PostEdit::class, 'showPostToEdit'])->name('edit_post');
Route::get('post/{postID}', [ViewPost::class, 'showPost'])->name('post_view_full');
Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');
Route::get('comment/edit/{commentID}', [EditCommentController::class, 'showCommentEdit'])->name('edit_comment');


