<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImgController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->post('/create-plan', [PlanController::class, 'create']);
Route::middleware('auth:api')->get('/get-plan', [PlanController::class, 'get']);
Route::middleware('auth:api')->post('/edit-name-plan', [PlanController::class, 'editname']);
Route::middleware('auth:api')->post('/delete-plan', [PlanController::class, 'delete']);


Route::middleware('auth:api')->post('/create-img', [ImgController::class, 'create']);
Route::middleware('auth:api')->get('/get-img', [ImgController::class, 'get']);

Route::middleware('auth:api')->post('/create-task', [TaskController::class, 'create']);
Route::middleware('auth:api')->post('/update-task', [TaskController::class, 'Update']);


Route::post('/checklogin', [AuthController::class, 'CheckLogin']);
Route::post('/reg', [AuthController::class, 'register']);
Route::middleware('auth:api')->get('/authcheck', [AuthController::class, 'authCheck']);
