<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TesController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/datakaryawan', function () {
    return view('hrd.index');
})->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::resource('datakaryawanAjax', hrdController::class);
    Route::middleware(['role:it'])->group(function () {
        Route::get('/datakaryawanAjax/create', [HrdController::class, 'create'])->name('datakaryawanAjax.create');
        Route::post('/datakaryawan', [HrdController::class, 'store'])->name('datakaryawan.store');
    });

  
    Route::middleware(['role:it'])->group(function () {
        Route::get('gajiAjax', [GajiController::class, 'index'])->name('gajiAjax.index');
        Route::get('gajiAjax/create', [GajiController::class, 'create'])->name('gajiAjax.create');
        Route::post('gajiAjax', [GajiController::class, 'store'])->name('gajiAjax.store');
        Route::get('gajiAjax/{gajiAjax}/edit', [GajiController::class, 'edit'])->name('gajiAjax.edit');
        Route::put('gajiAjax/{gajiAjax}', [GajiController::class, 'update'])->name('gajiAjax.update');
        Route::delete('gajiAjax/{gajiAjax}', [GajiController::class, 'destroy'])->name('gajiAjax.destroy');
    });
    Route::middleware(['role:manager'])->group(function () {
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
