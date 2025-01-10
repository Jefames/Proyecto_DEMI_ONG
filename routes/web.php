<?php

use App\Http\Controllers\RegistroAtencionSedesController;
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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallCenterController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\CordInterintitucionalController;


//Route::get('/', function () {
//    return view('auth.login');
//});

Route::post('/register', [AuthController::class, 'register'])->name('registro');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['check_role:Administrador']], function () {
        // Rutas accesibles solo para administradores

        //USERS
        Route::get('/users/create', [AuthController::class, 'create'])->name('users.create');
        Route::post('/users', [AuthController::class, 'store'])->name('users.store');
        Route::get('/users', [AuthController::class, 'index'])->name('users.index');
        Route::get('/user/edit/{id}', [AuthController::class, 'edit'])->name('users.edit');
        Route::put('/user/{id}', [AuthController::class, 'update'])->name('users.update');

        Route::patch('/user/{id}/inactivar',  [AuthController::class, 'inactivar'])->name('users.inactivar');
        Route::patch('/user/{id}/activar',  [AuthController::class, 'activar'])->name('users.activar');

        //CATALOGOS
        // <DISCAPACIDADES>
        Route::get('/catalogs/discapacidades/create', [CatalogsController::class, 'create_disc'])->name('discapacidades.create');
        Route::post('/catalogs/discapacidades', [CatalogsController::class, 'store_disc'])->name('discapacidades.store');
        Route::get('/catalogs/discapacidades', [CatalogsController::class, 'index_disc'])->name('discapacidades.index');
        Route::get('/catalogs/discapacidades/edit/{id}', [CatalogsController::class, 'edit_disc'])->name('discapacidades.edit');
        Route::put('/catalogs/discapacidades/{id}', [CatalogsController::class, 'update_disc'])->name('discapacidades.update');

        // <PUEBLOS>
        Route::get('/catalogs/pueblos/create', [CatalogsController::class, 'create_pueb'])->name('pueblos.create');
        Route::post('/catalogs/pueblos', [CatalogsController::class, 'store_pueb'])->name('pueblos.store');
        Route::get('/catalogs/pueblos', [CatalogsController::class, 'index_pueb'])->name('pueblos.index');
        Route::get('/catalogs/pueblos/edit/{id}', [CatalogsController::class, 'edit_pueb'])->name('pueblos.edit');
        Route::put('/catalogs/pueblos/{id}', [CatalogsController::class, 'update_pueb'])->name('pueblos.update');



    });
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//middleware('role:Administrador');

    Route::group(['middleware' => ['check_service:01']], function () {
        //INFORMES CALL CENTERS / CENTRO DE LLAMADAS
    Route::get('/expediente/create', [CallCenterController::class, 'create'])->name('call_centers.create');
    Route::post('/expediente', [CallCenterController::class, 'store'])->name('call_centers.store');
    Route::get('/expediente/consultas', [CallCenterController::class, 'index'])->name('call_centers.index');
    Route::get('/expediente/reportes', [CallCenterController::class, 'reportes'])
        ->name('call_centers.reportes');
    Route::post('/expediente/reporte/export', [CallCenterController::class, 'generarReporte'])
        ->name('call_centers.reporte.export');
    Route::get('/expediente/{expediente}', [CallCenterController::class, 'show'])->name('call_centers.show');
    Route::get('/expediente/edit/{expediente}', [CallCenterController::class, 'edit'])
        ->name('call_centers.edit');
    Route::put('/expediente/{id}', [CallCenterController::class, 'update'])
        ->name('call_centers.update');
    Route::patch('/expediente/{id}/delete',  [CallCenterController::class, 'inactivar'])
        ->name('call_centers.inactivar');
    });

    Route::group(['middleware' => ['check_service:02']], function () {
        //INFORMES COORDINACION INTERINSTITUCIONAL
    Route::get('/expediente-ci/create', [CordInterintitucionalController::class, 'create'])
        ->name('cord_interinstitucional.create');
    Route::post('/expediente-ci', [CordInterintitucionalController::class, 'store'])
        ->name('cord_interinstitucional.store');
    Route::get('/expediente-ci/consultas', [CordInterintitucionalController::class, 'index'])
        ->name('cord_interinstitucional.index');
    Route::get('/expediente-ci/reportes', [CordInterintitucionalController::class, 'reportes'])
        ->name('cord_interinstitucional.reportes');
    Route::post('/expediente-ci/reporte/export', [CordInterintitucionalController::class, 'generarReporte'])
        ->name('cord_interinstitucional.reporte.export');
    Route::get('/expediente-ci/{expediente}', [CordInterintitucionalController::class, 'show'])
        ->name('cord_interinstitucional.show');
    Route::patch('/expediente-ci/{id}/delete',  [CordInterintitucionalController::class, 'inactivar'])
        ->name('cord_interinstitucional.inactivar');
    Route::get('/expediente-ci/edit/{expediente}', [CordInterintitucionalController::class, 'edit'])
        ->name('cord_interinstitucional.edit');
    Route::put('/expediente-ci/{id}', [CordInterintitucionalController::class, 'update'])
        ->name('cord_interinstitucional.update');
    });

    Route::get('/expediente-re/create',[RegistroAtencionSedesController::class, 'create'])
        ->name('registro_sedes.create');
    Route::post('/expediente-re', [RegistroAtencionSedesController::class, 'store'])
        ->name('registro_sedes.store');
    Route::get('/municipios/{id}', [RegistroAtencionSedesController::class, 'getMunicipios'])
        ->name('municipios.get');
    Route::get('/expediente-re/consultas', [RegistroAtencionSedesController::class, 'index'])
        ->name('registro_sedes.index');
    Route::get('/expediente-re/reportes', [RegistroAtencionSedesController::class, 'reportes'])
        ->name('registro_sedes.reportes');
    Route::post('/expediente-re/reporte/export', [RegistroAtencionSedesController::class, 'generarReporte'])
        ->name('registro_sedes.reporte.export');
    Route::get('/expediente-re/{id}', [RegistroAtencionSedesController::class, 'show'])
        ->name('registro_sedes.show');
    Route::get('/expediente-re/edit/{id}', [RegistroAtencionSedesController::class, 'edit'])
        ->name('registro_sedes.edit');
    Route::post('/expediente-re/update/{id}', [RegistroAtencionSedesController::class, 'update'])
        ->name('registro_sedes.update');



    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');
});


