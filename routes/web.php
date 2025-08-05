<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Models\Inventaris;
use App\Models\Jenis;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'auth_login'])->name('auth_login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // Route::get('/jenis', function () {
    //     return view('jenis.index');
    // });

    // route untuk jenis
    Route::get('/jenis', [JenisController::class, 'index'])->name('jenis.index');
    Route::get('/jenis/create', [JenisController::class, 'create'])->name('jenis.create');
    Route::post('/jenis/store', [JenisController::class, 'store'])->name('jenis.store');
    Route::get('/jenis/{id}/edit', [JenisController::class, 'edit'])->name('jenis.edit');
    Route::put('/jenis/{id}', [JenisController::class, 'update'])->name('jenis.update');
    Route::delete('/jenis/{id}', [JenisController::class, 'destroy'])->name('jenis.destroy');

    // route untuk unit
    Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
    Route::get('/unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('/unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('/unit{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/unit/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::delete('/unit/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');

    // route untuk user&role
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'storeOrUpdate'])->name('user.store');
    Route::put('/user/{id}', [UserController::class, 'storeOrUpdate'])->name('user.update');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role', [RoleController::class, 'storeOrUpdate'])->name('role.store');
    Route::put('/role/{id}', [RoleController::class, 'storeOrUpdate'])->name('role.update');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    //route inventaris
    Route::get('/inventaris/index', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::post('/inventaris', [InventarisController::class, 'storeOrUpdate'])->name('inventaris.store');
    Route::put('/inventaris/{id}', [InventarisController::class, 'storeOrUpdate'])->name('inventaris.update');
    Route::get('/inventaris/{id}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::delete('/inventaris/{id}', [InventarisController::class, 'destroy'])->name('Inventaris.destroy');

    //route kegiatan
    Route::get('/kegiatan/index', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::post('/kegiatan', [KegiatanController::class, 'storeOrUpdate'])->name('kegiatan.store');
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'storeOrUpdate'])->name('kegiatan.update');
    Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    //profile saya
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    //searching
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.global');

});
