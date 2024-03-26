<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/weather', [WeatherController::class, 'fetchWeatherData'])->middleware('auth:sanctum');

Route::post('/auth/register', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
