<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// Employee Form
Route::get('/', [EmployeeController::class, 'index']);
Route::post('/save', [EmployeeController::class, 'store']);
Route::get('/edit/{id}', [EmployeeController::class, 'edit']);
Route::post('/update/{id}', [EmployeeController::class, 'update']);
Route::get('/delete/{id}', [EmployeeController::class, 'destroy']);

// Google Login
Route::get('/auth/google', [AuthController::class, 'redirect']);
Route::get('/auth/google/callback', [AuthController::class, 'callback']);

// Logout
Route::get('/logout', function () {

    Auth::logout();

    session()->invalidate();
    session()->regenerateToken();

    return redirect('/');

});