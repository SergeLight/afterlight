<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WallController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index']);

// Authentication
Route::get('/register', [AuthenticationController::class, 'authenticationPage'])->name('register')->middleware('guest');
Route::get('/login', [AuthenticationController::class, 'authenticationPage'])->name('login')->middleware('guest');
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth');

Route::post('/register-submit', [AuthenticationController::class, 'register']);
Route::post('/login-submit', [AuthenticationController::class, 'login']);

// Google Auth
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth')->middleware('guest');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle']);

// Wall
Route::get('/wall', [WallController::class, 'showWallFeed'])->middleware('auth');
Route::get('/following', [WallController::class, 'showFollowingFeed'])->middleware('auth');
