<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'welcome']);

Route::get('documents/recherche', [HomeController::class, 'search'])->name('documents.search');

Route::get('/read-{fileName}-file', [HomeController::class, 'show'])->name('read.file');
Route::get('/download-{id}-file', [HomeController::class, 'download'])->name('download.file');


Route::group(['middleware' =>['auth', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::middleware('admin')->group(function () {
        Route::put('change-status', [UserController::class, 'changeStatus'])->name('user.change-status');
        Route::put('generate-password', [UserController::class, 'generatePassword'])->name('user.generate-password');
        Route::resource('type-document', TypeController::class);
        Route::resource('user', UserController::class);

        Route::get('document-trash', [TrashedController::class, 'index'])->name('trash.index');
        Route::put('document-{id}-restore', [TrashedController::class, 'restore'])->name('trash.restore');
        Route::delete('document-{id}-delete', [TrashedController::class, 'forceDelete'])->name('trash.delete');

    });

    Route::get('dashbord', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('document', DocumentController::class);
    Route::get('/file-{id}-download', [DocumentController::class, 'download'])->name('file.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile-update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

require __DIR__.'/auth.php';
