<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);

// register
Route::get('register', [AuthController::class, 'register']);

// login
Route::post('login', [AuthController::class, 'login']);

// logout
Route::post('logout', [AuthController::class, 'logout']);

// get all user
Route::get('getalluser', [AuthController::class, 'getalluser']);

//=== employee ===//
Route::apiResource('employees', EmployeeController::class);

// upload file
Route::post('upload', [FileController::class, 'upload']);

//=== department ===//
Route::apiResource('departments', DepartmentController::class);
