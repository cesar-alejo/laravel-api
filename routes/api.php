<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\RegisteredUserController;
use App\Http\Controllers\API\Auth\AuthenticatedController;

use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\UserController;

//Route::get('/user', function (Request $request) {
//    return ['data' => User::all(), 'in' => $request->user];
//})->middleware('auth:sanctum');

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);

    Route::post('logout', [AuthenticatedController::class, 'destroy']);
});

Route::apiResource('/file', FileController::class);
//Route::apiResource('/file', FileController::class, array('as', 'api'));
