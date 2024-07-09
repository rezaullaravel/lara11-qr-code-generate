<?php

use App\Http\Controllers\PhotoUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhotoUploadController::class, 'index']);
Route::post('/photo/upload', [PhotoUploadController::class, 'photoUpload'])->name('photo.upload');
Route::get('/delete/{id}', [PhotoUploadController::class, 'delete'])->name('delete');
Route::get('/download/{id}', [PhotoUploadController::class, 'download'])->name('download');
Route::get('/foo', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = public_path('storage');
    symlink($targetFolder, $linkFolder);
});
