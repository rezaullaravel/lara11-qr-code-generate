<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PhotoUploadController;



Route::middleware(['admin'])->group(function(){
    Route::get('/', [PhotoUploadController::class,'index']);
    Route::post('/photo/upload',[PhotoUploadController::class,'photoUpload'])->name('photo.upload');
    Route::get('/delete/{id}', [PhotoUploadController::class,'delete'])->name('delete');
});


//admin auth route
Route::get('/login',[UserAuthController::class,'index']);
Route::post('/post/login',[UserAuthController::class,'postLogin'])->name('admin.login');
Route::get('/logout',[UserAuthController::class,'logout'])->name('admin.logout')->middleware('admin');
Route::get('/password/change',[UserAuthController::class,'changePassword'])->name('admin.password.change')->middleware('admin');
Route::post('/password/update',[UserAuthController::class,'updatePassword'])->name('admin.password.update')->middleware('admin');

