<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RadicationMailController;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('file', [FileController::class, 'index'])->name('files.index');
    Route::get('file/create', [FileController::class, 'create'])->name('files.create');
    Route::post('file', [FileController::class, 'store'])->name('files.store');
    Route::get('file/{id}', [FileController::class, 'show'])->name('files.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/auth', [UserController::class, 'auth'])->name('users.auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/mail', MailController::class)->name('mail.index');
    Route::get('/rmail', [RadicationMailController::class, 'index'])->name('rmail.index');
});

require __DIR__ . '/auth.php';
