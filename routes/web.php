<?php

use App\Http\Controllers\AlgoritmaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', [UserController::class, 'login'])->name('login');

// login & register
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

//admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('berandaadmin', [BerandaController::class, 'berandaadmin'])->name('berandaadmin');
    Route::resource('kriterias', KriteriaController::class);
    Route::resource('subkriterias', SubkriteriaController::class);
    
    //perhitungan
    Route::get('perhitungan', [AlgoritmaController::class, 'index'])->name('perhitungan.index');

    Route::resource('masyarakats', MasyarakatController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::get('rangking', [AlgoritmaController::class, 'rank'])->name('rangking.index');
});

//petugas
Route::middleware(['auth', 'user-access:petugas'])->group(function () {
    Route::get('beranda', [BerandaController::class, 'beranda'])->name('beranda');
    // Route::resource('masyarakats', MasyarakatController::class);
    // Route::resource('penilaian', PenilaianController::class);
    // Route::get('rangking', [AlgoritmaController::class, 'rank'])->name('rangking.index');
});