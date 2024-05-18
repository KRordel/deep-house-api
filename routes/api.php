<?php

use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\FaqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::resource('users', UserController::class);
    Route::resource('faqs', FaqController::class);
});
