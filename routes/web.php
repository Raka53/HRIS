<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
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
Route::get('/datakaryawan', function () {
    return view('hrd.index');
});
Route::get('/datakaryawan/form', function () {
    return view('hrd.form');
});
Route::resource('datakaryawanAjax', hrdController::class);