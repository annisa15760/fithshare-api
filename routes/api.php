<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClothController;
use App\Http\Controllers\Api\ClaimController;

// 5 Endpoint CRUD Utama Pakaian
Route::get('/clothes', [ClothController::class, 'index']);
Route::post('/clothes', [ClothController::class, 'store']);
Route::get('/clothes/{id}', [ClothController::class, 'show']);
Route::put('/clothes/{id}', [ClothController::class, 'update']);
Route::delete('/clothes/{id}', [ClothController::class, 'destroy']);

Route::post('/claims', [ClaimController::class, 'store']);