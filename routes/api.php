<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\API\Auth\RegisteredUserController;
use App\Http\Controllers\API\Auth\AuthenticatedController;
use App\Http\Controllers\API\FileController;

use App\Models\User;

Route::get('/user', function (Request $request) {
    return ['data' => User::all(), 'in' => $request->user];
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthenticatedController::class, 'destroy']);
});

Route::post('register', [RegisteredUserController::class, 'store']);
Route::post('login', [AuthenticatedController::class, 'store']);

Route::apiResource('/file', FileController::class);
//Route::apiResource('/file', FileController::class, array('as', 'api'));
