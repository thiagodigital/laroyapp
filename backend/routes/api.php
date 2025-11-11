<?php

use App\Http\Controllers\Api\MediaUploadController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['running' => true]);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/media', [MediaUploadController::class, 'store'])
        ->name('media.store');
});

