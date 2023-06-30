<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['guest:pegawai'])->group(function () {
    Route::get('/', function () {
        return view('auth/login');
    })->name('login');
});

Route::post('/proses-login', [AuthController::class, 'proseslogin']);


Route::middleware(['auth:pegawai'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index']);
    Route::get('/proses-logout', [AuthController::class, 'proseslogout']);

    // PRESENSI 
    Route::get('/presensi/create', [PresensiController::class, 'create']);
});
