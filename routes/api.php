<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingtypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupassetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\SuppilerController;
use App\Http\Controllers\TypeassetController;
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

// get data join with departments
Route::get('getdataJoindepartments', [EmployeeController::class, 'getdataJoindepartments']);

// upload file
Route::post('upload', [FileController::class, 'upload']);

//=== department ===//
Route::apiResource('departments', DepartmentController::class);

//=== suppiler ===//
Route::apiResource('suppilers', SuppilerController::class);

//=== room ===//
Route::apiResource('rooms', RoomController::class);

// get data join roomtype
Route::get('getdataJoinroomtypes', [RoomController::class, 'getdataJoinroomtypes']);

//=== roomtype ===//
Route::apiResource('roomtypes', RoomtypeController::class);

//=== building ===//
Route::apiResource('buildings', BuildingController::class);

// get data join buildingtypes
Route::get('getdataJoinbuildingtypes', [BuildingController::class, 'getdataJoinbuildingtypes']);

//=== buildingtype ===//
Route::apiResource('buildingtypes', BuildingtypeController::class);

//=== groupasset ===//
Route::apiResource('groupassets', GroupassetController::class);
// get only active
Route::get('getGroupassetOnlyActive', [GroupassetController::class, 'getGroupassetOnlyActive']);

//=== typeasset ===//
Route::apiResource('typeassets', TypeassetController::class);

// get data type join group asset
Route::get('getdataJoingroupasset', [TypeassetController::class, 'getdataJoingroupasset']);
