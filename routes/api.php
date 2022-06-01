<?php

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
Route::post('/create-plan', [PlanController::class, 'create']);
Route::get('/get-plan', [PlanController::class, 'get']);


Route::post('/create-img', [ImgController::class, 'create']);

Route::post('/create-task', [TaskController::class, 'create']);
