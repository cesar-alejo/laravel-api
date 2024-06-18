<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;

Route::get('/user', function () {
    return ['data' => User::all()];
})->middleware('auth:sanctum');
