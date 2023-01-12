<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubkriteriaController;
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

Route::get('/', [UserController::class, 'login'])->name('login');

Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');

// user
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// masyarakat
Route::resource('masyarakats', MasyarakatController::class);
Route::resource('penilaian', PenilaianController::class);

//kriteria
Route::resource('kriterias', KriteriaController::class);
Route::resource('subkriterias', SubkriteriaController::class);