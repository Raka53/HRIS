<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\hrdController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SewaKendaraanController;
use App\Http\Controllers\MedicalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




Route::middleware(['auth'])->group(function () {

  Route::resource('events', EventController::class);


        Route::get('medical', [MedicalController::class, 'index'])->name('medical.index'); // Add this line
        Route::get('medical/{medical}', [MedicalController::class, 'show'])->name('medical.show');
    // Add patient to medical claim
    Route::get('medical/{id}/add-patient', [MedicalController::class, 'create'])->name('medical.create_patient');
    Route::post('medical', [MedicalController::class, 'store'])->name('medical.store');
    Route::get('medical/{medical}/edit', [MedicalController::class, 'edit'])->name('medical.edit');
    Route::put('medical/{medical}', [MedicalController::class, 'update'])->name('medical.update');
    Route::delete('medical/{medical}', [MedicalController::class, 'destroy'])->name('medical.destroy');

    // Get medical data for DataTables
    Route::get('medical/detail/{medical}/data', [MedicalController::class, 'getMedicalData'])->name('medical.detail.data');


    Route::get('/hrdJson', [GajiController::class, 'hrdJson'])->name('hrdJson');

    Route::get('medical/{id}/add-patient', [MedicalController::class, 'create'])->name('medical.create_patient');

   // Rute untuk menampilkan data karyawan yang telah dihapus (Soft Delete)
    Route::get('/hrd/deleted', [hrdController::class, 'showDeletedData'])->name('hrd.showDeletedData');

    // Rute untuk mengembalikan data karyawan yang telah dihapus
    Route::patch('/hrd/restore/{id}', [hrdController::class, 'restoreHrdData'])->name('hrd.restore');

    Route::get('datakaryawan', [dataController::class, 'datakry'])->name('datakaryawan.datakry');
    Route::get('datakaryawanAjax', [hrdController::class, 'index'])->name('datakaryawanAjax.index');
    Route::get('datakaryawanAjax/export/excel', [hrdController::class, 'exportExcel'])->name('export.kry');

    Route::get('datakandidat', [dataController::class, 'datakdt'])->name('datakaryawan.datakdt');
    Route::get('datakandidat/{id}/edit', [KandidatController::class, 'edit'])->name('datakandidat.edit');
    Route::patch('datakandidat/{id}', [KandidatController::class, 'update'])->name('datakandidat.update');
    Route::get('dataStatus', [dataController::class, 'dataStatus'])->name('datakaryawan.dataStatus');
    Route::get('statusData', [dataController::class, 'statusData'])->name('kandidat.dataStatus');
    Route::get('kandidat', [KandidatController::class, 'index'])->name('kandidat.index');
    Route::get('statuskandidat', [KandidatController::class, 'status'])->name('statuskandidat.status');
    Route::get('/datakandidat/create', [KandidatController::class, 'create'])->name('datakandidat.create');
    Route::get('/statusKdt/create', [KandidatController::class, 'createStatus'])->name('statusKdt.create');
    Route::post('kandidatStore', [KandidatController::class, 'store'])->name('kandidat.store');
    Route::post('statusTambah', [KandidatController::class, 'storeStatus'])->name('tambahStatus.store');
    Route::get('statusKdt/{id}/edit', [dataController::class, 'editStatus'])->name('statusKdt.edit');
    Route::patch('statusKdt/{id}', [dataController::class, 'updateStatus'])->name('updateKdt.update');

    //cari gaji
    Route::get('/cari-gaji', [GajiController::class,'cari'])->name('gaji.cari');
    Route::get('hasilGaji', [dataController::class,'dataCari'])->name('hasil.cari-gaji');
    Route::get('detailCari/{id}/show', [GajiController::class,'detailCari'])->name('detail.cari');
    Route::get('gaji/export/excel', [GajiController::class,'exportExcel'])->name('export.gaji');
    Route::get('gaji/related-data/{hrd_id}', [dataController::class, 'relatedData'])->name('gaji.related-data');







    Route::get('/hrdJsonEdit/{id}', [GajiController::class, 'hrdJsonEdit'])->name('hrdJsonEdit');

        Route::resource('adminController', AdminController::class);
        Route::resource('SewaKendaraan', SewaKendaraanController::class);
        Route::get('/datakaryawanAjax/create', [hrdController::class, 'create'])->name('datakaryawanAjax.create');
        Route::post('datakaryawanAjax', [hrdController::class, 'store'])->name('datakaryawanAjax.store');

        Route::patch('datakaryawanAjax/{id}', [hrdController::class, 'update'])->name('datakaryawanAjax.update');
        Route::delete('datakaryawanAjax/{id}', [hrdController::class, 'destroy'])->name('datakaryawanAjax.destroy');



        Route::get('datakaryawanAjax/{id}/edit', [HrdController::class, 'edit'])->name('datakaryawanAjax.edit');

        Route::resource('gajiAjax', GajiController::class);
        Route::get('/hrdJson', [GajiController::class, 'hrdJson'])->name('hrdJson');

    Route::middleware(['role:it|manager'])->group(function () {

    });
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
