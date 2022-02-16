<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::get('register', [AuthController::class, 'register']);

// login
Route::post('login', [AuthController::class, 'login']);

// logout
Route::post('logout', [AuthController::class, 'logout']);
