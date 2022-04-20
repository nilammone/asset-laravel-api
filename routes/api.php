<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingtypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupassetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SuppilerController;
use App\Http\Controllers\TypeassetController;
use App\Models\Sponsor;
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

// change password
Route::post('change_password', [AuthController::class, 'change_password']);

// get all user
Route::get('getalluser', [AuthController::class, 'getalluser']);
// get join employees
Route::get('getdatajoinemployee', [AuthController::class, 'getdatajoinemployee']);
// delete user
Route::get('deleteuser/{userid}', [AuthController::class, 'deleteuser']);

//=== employee ===//
Route::apiResource('employees', EmployeeController::class);

// get data join with departments
Route::get('getdataJoindepartments', [EmployeeController::class, 'getdataJoindepartments']);

// upload file
Route::post('upload', [FileController::class, 'upload']);
// delete image
Route::get('deleteimage/{filename}', [FileController::class, 'deleteimage']);

//=== department ===//
Route::apiResource('departments', DepartmentController::class);

//=== suppiler ===//
Route::apiResource('suppilers', SuppilerController::class);

//=== sponsor ===//
Route::apiResource('sponsors', SponsorController::class);

//=== room ===//
Route::apiResource('rooms', RoomController::class);

// get data room active
Route::get('getRoomOnlyActive', [RoomController::class, 'getRoomOnlyActive']);

// get data join roomtype
Route::get('getdataJoinroomtypes', [RoomController::class, 'getdataJoinroomtypes']);

//=== roomtype ===//
Route::apiResource('roomtypes', RoomtypeController::class);

//=== building ===//
Route::apiResource('buildings', BuildingController::class);

// get data building only active
Route::get('getBuildingOnlyActive', [BuildingController::class, 'getBuildingOnlyActive']);

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

// get data type active
Route::get('getTypeassetOnlyActive', [TypeassetController::class, 'getTypeassetOnlyActive']);
// get data by group asset id
// Route::get('getByGroupassetId', [TypeassetController::class, 'getByGroupassetId']);
Route::get('getByGroupassetId/{gid}', [TypeassetController::class, 'getByGroupassetId']);

// get data type join group asset
Route::get('getdataJoingroupasset', [TypeassetController::class, 'getdataJoingroupasset']);

//=== asset ===//
Route::apiResource('assets', AssetController::class);

// get join more
Route::get('getdataJoinmore', [AssetController::class, 'getdataJoinmore']);

// get join more active by date
Route::get('getdataJoinmoreActiveByDate/{startDate}/{endDate}', [AssetController::class, 'getdataJoinmoreActiveByDate']);

// get join more active not date
Route::get('getdataJoinmoreActiveNotDate', [AssetController::class, 'getdataJoinmoreActiveNotDate']);

// get join more active by groupid userid
Route::get('getdataJoinmoreActiveByUseridGroupid/{userId}/{groupId}', [AssetController::class, 'getdataJoinmoreActiveByUseridGroupid']);

// get report all
Route::get('getdataReportAll/{startDate}/{endDate}', [AssetController::class, 'getDataReportAll']);

// get report all not date
Route::get('getdataReportAllNotDate', [AssetController::class, 'getDataReportAllNotDate']);

// ==== get count dashboard ==== //
// get all assets
Route::get('countAllAssets', [AssetController::class, 'countAllAssets']);

// get all buildings
Route::get('countAllBuildings', [AssetController::class, 'countAllBuildings']);

// get all rooms
Route::get('countAllRooms', [AssetController::class, 'countAllRooms']);

// get all suppilers
Route::get('countAllSuppilers', [AssetController::class, 'countAllSuppilers']);
