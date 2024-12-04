<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('projects', ProjectController::class);

Route::get('tasks/{project}', [TaskController::class, 'index']);

Route::get('tasks/{project}/{task}', [TaskController::class, 'show']);

Route::delete('tasks/{project}/{task}', [TaskController::class, 'destroy']);

Route::put('tasks/{project}/{task}', [TaskController::class, 'update']);

Route::post('tasks/{project}/{task}', [TaskController::class, 'store']);




