<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

Route::post('/penyakit', [DataController::class, 'getPenyakit'])->middleware('auth:sanctum');
Route::post('/gejala', [DataController::class, 'getGejala'])->middleware('auth:sanctum');
Route::post('/psikolog', [DataController::class, 'getPsikolog'])->middleware('auth:sanctum');
