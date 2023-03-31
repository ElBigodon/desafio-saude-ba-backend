<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('users')->group(function () {
    Route::get('/',               [UserController::class, 'getAll']);
    Route::get('/{id}',           [UserController::class, 'get']);
    Route::post('/create',        [UserController::class, 'create']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
    Route::patch('/update/{id}',  [UserController::class, 'update']);
});
