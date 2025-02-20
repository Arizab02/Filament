<?php

use App\Http\Controllers\waController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('wa/{target}/{message}', [waController::class, 'waSend'])->name('waSend');