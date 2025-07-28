<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test',[PostController::class , 'test']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
