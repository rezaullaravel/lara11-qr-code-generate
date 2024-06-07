<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoUploadController;

Route::get('/', [PhotoUploadController::class,'index']);
Route::post('/photo/upload',[PhotoUploadController::class,'photoUpload'])->name('photo.upload');
Route::get('/delete/{id}', [PhotoUploadController::class,'delete'])->name('delete');

