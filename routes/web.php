<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AttachmentController;
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
    Route::get('file/{id}/attach', [FileController::class, 'attach'])->name('files.attach');
    Route::get('file/{id}/recip', [FileController::class, 'recip'])->name('files.recip');
    Route::get('file/{id}/history', [FileController::class, 'history'])->name('files.history');
    Route::delete('file/{id}', [FileController::class, 'destroy'])->name('files.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('attachments/{model}/{id}', [AttachmentController::class, 'attachTo'])->name('attachments.attach');
    //Route::delete('attachments/{model}/{id}/{attachmentId}', [AttachmentController::class, 'detachFrom'])->name('attachments.detach');

});

//Route::prefix('api')->group(function () {
//    Route::apiResource('attachments', AttachmentController::class);
//    
//    // Rutas adicionales específicas
//    Route::post('attachments/{model}/{id}', [AttachmentController::class, 'attachTo'])->name('api.attachments.attach');
//    Route::delete('attachments/{model}/{id}/{attachmentId}', [AttachmentController::class, 'detachFrom'])->name('api.attachments.detach');
//});

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/auth', [UserController::class, 'auth'])->name('users.auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/mail', MailController::class)->name('mail.index');
    Route::get('/rmail', [RadicationMailController::class, 'index'])->name('rmail.index');
});

// Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
//     Route::resources([
//         'file' => FileController::class,
//         'rmail' => RadicationMailController::class
//     ]);
// });

require __DIR__ . '/auth.php';
