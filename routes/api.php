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

// Jika ada middleware(auth:sanctum) itu artinya route membutuhkan akses token

//Logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//PRofile
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

//route data untuk get semua data (penyakit, gejala, psikolog)
Route::post('/data', [DataController::class, 'getAllData'])->middleware('auth:sanctum');

//route untuk mengambil data penyakit saja
Route::post('/penyakit', [DataController::class, 'getPenyakit'])->middleware('auth:sanctum');
//route untuk mengambil data gejala saja
Route::post('/gejala', [DataController::class, 'getGejala'])->middleware('auth:sanctum');
//route untuk mengambil data psikolog saja
Route::post('/psikolog', [DataController::class, 'getPsikolog'])->middleware('auth:sanctum');
//route untuk mengambil data riwayat saja
Route::post('/riwayat', [DataController::class, 'getRiwayat'])->middleware('auth:sanctum');
//route untuk menghitung CF 
Route::post('hitung', [DataController::class, 'hitung'])->middleware('auth:sanctum');
