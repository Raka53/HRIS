<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/datakaryawan', function () {
    return view('hrd.index');
})->middleware('auth');
Route::get('/datakaryawan/form', function () {
    return view('hrd.form');
})->middleware('auth');
Route::get('/gaji', function () {
    return view('gaji.index');
})->middleware('auth');

Route::resource('datakaryawanAjax', hrdController::class)->middleware('auth');


Route::resource('gajiAjax', GajiController::class)->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('auth');
Route::post('/register', [AuthController::class, 'register'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');