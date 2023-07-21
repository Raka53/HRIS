<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SewaKendaraanController;
use App\Http\Controllers\MedicalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('medical', MedicalController::class);
    
    

        Route::get('datakaryawan', [dataController::class, 'datakry'])->name('datakaryawan.datakry');
        Route::get('medical/detail/{medical}/data', [MedicalController::class, 'getMedicalData'])
    ->name('medical.detail.data');
       
        Route::get('datakaryawanAjax', [hrdController::class, 'index'])->name('datakaryawanAjax.index');
        
      
      
        
        Route::get('medical/{id}/add-patient', [MedicalController::class, 'create'])->name('medical.create_patient');
    
    
    
    
    
    
        Route::resource('adminController', AdminController::class);
        Route::resource('SewaKendaraan', SewaKendaraanController::class);
        Route::get('/datakaryawanAjax/create', [hrdController::class, 'create'])->name('datakaryawanAjax.create');
        Route::post('datakaryawanAjax', [hrdController::class, 'store'])->name('datakaryawanAjax.store');
        
        Route::patch('datakaryawanAjax/{id}', [hrdController::class, 'update'])->name('datakaryawanAjax.update');
        Route::delete('datakaryawanAjax/{id}', [hrdController::class, 'destroy'])->name('datakaryawanAjax.destroy');
  

   
        Route::get('datakaryawanAjax/{id}/edit', [HrdController::class, 'edit'])->name('datakaryawanAjax.edit');
   

  
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
