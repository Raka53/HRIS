<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SewaKendaraanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('datakaryawan', [dataController::class, 'datakry'])->name('datakaryawan.datakry');
    Route::get('datakaryawanAjax', [hrdController::class, 'index'])->name('datakaryawanAjax.index');
    Route::resource('adminController', AdminController::class);
    Route::resource('SewaKendaraan', SewaKendaraanController::class);

    Route::middleware(['role:it'])->group(function () {
        Route::get('/datakaryawanAjax/create', [hrdController::class, 'create'])->name('datakaryawanAjax.create');
        Route::post('datakaryawanAjax', [hrdController::class, 'store'])->name('datakaryawanAjax.store');
        
        Route::patch('datakaryawanAjax/{id}', [hrdController::class, 'update'])->name('datakaryawanAjax.update');
        Route::delete('datakaryawanAjax/{id}', [hrdController::class, 'destroy'])->name('datakaryawanAjax.destroy');
    });

    Route::middleware(['role:spv|it|manager'])->group(function () {
        Route::get('datakaryawanAjax/{id}/edit', [HrdController::class, 'edit'])->name('datakaryawanAjax.edit');
    });

  
    Route::middleware(['role:it|manager'])->group(function () {
        Route::get('gajiAjax', [GajiController::class, 'index'])->name('gajiAjax.index');
        Route::get('gajiAjax/create', [GajiController::class, 'create'])->name('gajiAjax.create');
        Route::post('gajiAjax', [GajiController::class, 'store'])->name('gajiAjax.store');
        Route::get('gajiAjax/{gajiAjax}/edit', [GajiController::class, 'edit'])->name('gajiAjax.edit');
        Route::put('gajiAjax/{gajiAjax}', [GajiController::class, 'update'])->name('gajiAjax.update');
        Route::delete('gajiAjax/{gajiAjax}', [GajiController::class, 'destroy'])->name('gajiAjax.destroy');
    });
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
