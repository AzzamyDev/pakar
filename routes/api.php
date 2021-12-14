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
//End Point

//Register
Route::post('/register', [AuthController::class, 'register']);

//Login
Route::post('/login', [AuthController::class, 'login']);

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//PRofile
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

Route::post('/data', [DataController::class, 'getAllData'])->middleware('auth:sanctum');
Route::post('/penyakit', [DataController::class, 'getPenyakit'])->middleware('auth:sanctum');
Route::post('/gejala', [DataController::class, 'getGejala'])->middleware('auth:sanctum');
Route::post('/psikolog', [DataController::class, 'getPsikolog'])->middleware('auth:sanctum');
Route::post('/riwayat', [DataController::class, 'getRiwayat'])->middleware('auth:sanctum');
Route::post('/riwayat/add', [DataController::class, 'addRiwayat'])->middleware('auth:sanctum');

Route::post('hitung', [DataController::class, 'hitung'])->middleware('auth:sanctum');
