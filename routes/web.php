<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PsikologController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//rute direct jika user belum login maka di arahkan ke halaman login
Route::get('/', function () {
    return redirect('login');
});

//Route Registrasi
Auth::routes(['register' => false]);

//route yang hanya bisa di akses oleh admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('psikologs', PsikologController::class);
});

//route home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//route yang bisa di akses oleh admin & psikolog
Route::group(['middleware' => ['role:admin|psikolog']], function () {
    Route::resource('indications', GejalaController::class);
    Route::resource('diseases', PenyakitController::class);
    Route::get('diseases/{id}/set-gejala', [PenyakitController::class, 'viewSet'])
        ->name('view_set_gejala');
    Route::post('diseases/{id}/set', [PenyakitController::class, 'setGejala'])
        ->name('set_gejala');
});

//Route pendukung
Route::resource('users', UserController::class);
Route::get('record/users', [UserController::class, 'record'])->name('record');
Route::get('search', [UserController::class, 'cari'])->name('cari_user');
Route::get('search/record', [UserController::class, 'getRecord'])->name('get_record');
