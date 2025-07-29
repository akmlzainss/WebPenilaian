<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminGuruController;
use App\Http\Controllers\GuruUserController;
use App\Http\Controllers\AdminMuridController;
use App\Http\Controllers\MuridUserController;
use App\Http\Controllers\AdminNilaiController;
use App\Http\Controllers\GuruNilaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMapelController;
use App\Http\Controllers\AdminActivityLogController;
use App\Http\Controllers\GuruMuridController;

// Route Guest (Login)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Redirect Berdasarkan Role
Route::get('/home', [AdminController::class, 'redirectBasedOnRole'])->name('home');

// Route yang Memerlukan Login
Route::middleware(['auth'])->group(function () {
    // Dashboard per Role
    Route::get('/admin', [AdminController::class, 'admin'])
        ->middleware('App\Http\Middleware\UserAkses:admin')
        ->name('admin.index');

    // GURU USER ROUTES
    Route::middleware(['App\Http\Middleware\UserAkses:guru'])
        ->prefix('guru')
        ->name('guru.')
        ->group(function () {
            Route::get('/dashboard', [GuruUserController::class, 'dashboard'])->name('dashboard');
            Route::get('/profil', [GuruUserController::class, 'profil'])->name('profil');
            Route::put('/profil/password', [GuruUserController::class, 'updatePassword'])->name('update.password');
            Route::get('/nilai', [GuruNilaiController::class, 'index'])->name('nilai.index');
            Route::get('/nilai/create', [GuruNilaiController::class, 'create'])->name('nilai.create');
            Route::post('/nilai', [GuruNilaiController::class, 'store'])->name('nilai.store');
            Route::get('/nilai/{nis}/{kode}/edit', [GuruNilaiController::class, 'edit'])->name('nilai.edit');
            Route::put('/nilai/{nis}/{kode}', [GuruNilaiController::class, 'update'])->name('nilai.update');
            Route::delete('/nilai/{nis}/{kode}', [GuruNilaiController::class, 'destroy'])->name('nilai.destroy');
            Route::get('/nilai/export', [GuruNilaiController::class, 'export'])->name('nilai.export');
            Route::get('/murid/search', [GuruMuridController::class, 'search'])->name('murid.search');

            // About Us
            Route::get('/about', [GuruUserController::class, 'about'])->name('about');

            // FAQ
            Route::get('/faq', [GuruUserController::class, 'faq'])->name('faq');
        });

    // MURID USER ROUTES
    Route::middleware(['App\Http\Middleware\UserAkses:murid'])
        ->prefix('murid')
        ->name('murid.')
        ->group(function () {
            Route::get('/dashboard', [MuridUserController::class, 'dashboard'])->name('dashboard');
            Route::get('/profil', [MuridUserController::class, 'profil'])->name('profil');
            Route::put('/update-profil', [MuridUserController::class, 'updateProfil'])->name('update.profil');
            Route::get('/nilai', [MuridUserController::class, 'nilai'])->name('nilai.index');
            Route::get('/nilai/export', [MuridUserController::class, 'export'])->name('nilai.export');

            // About Us
            Route::get('/about', [MuridUserController::class, 'about'])->name('about');

            // FAQ
            Route::get('/faq', [MuridUserController::class, 'faq'])->name('faq');
        });

    // ADMIN ONLY ROUTES
    Route::middleware(['App\Http\Middleware\UserAkses:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Dashboard Admin
            Route::get('/', [AdminController::class, 'admin'])->name('index');

            // Profil Admin
            Route::get('/profil', [AdminUserController::class, 'profil'])->name('profil');
            Route::post('/update-password', [AdminUserController::class, 'updatePassword'])->name('update.password');

            // About Us
            Route::get('/about', [AdminController::class, 'about'])->name('about');

            // FAQ
            Route::get('/faq', [AdminController::class, 'faq'])->name('faq');

            // Settings
            Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
            Route::post('/settings/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

            // CRUD Guru
            Route::get('/guru', [AdminGuruController::class, 'index'])->name('guru.index');
            Route::get('/guru/create', [AdminGuruController::class, 'create'])->name('guru.create');
            Route::post('/guru', [AdminGuruController::class, 'store'])->name('guru.store');
            Route::get('/guru/{nip}/edit', [AdminGuruController::class, 'edit'])->name('guru.edit');
            Route::put('/guru/{nip}', [AdminGuruController::class, 'update'])->name('guru.update');
            Route::delete('/guru/{nip}', [AdminGuruController::class, 'destroy'])->name('guru.destroy');
            Route::post('/guru/export', [AdminGuruController::class, 'export'])->name('guru.export');

            // CRUD Murid
            Route::get('/murid', [AdminMuridController::class, 'index'])->name('murid.index');
            Route::get('/murid/create', [AdminMuridController::class, 'create'])->name('murid.create');
            Route::post('/murid', [AdminMuridController::class, 'store'])->name('murid.store');
            Route::get('/murid/{nis}/edit', [AdminMuridController::class, 'edit'])->name('murid.edit');
            Route::put('/murid/{nis}', [AdminMuridController::class, 'update'])->name('murid.update');
            Route::delete('/murid/{nis}', [AdminMuridController::class, 'destroy'])->name('murid.destroy');
            Route::post('/murid/export', [AdminMuridController::class, 'export'])->name('murid.export');

            // CRUD User
            Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
            Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/user', [UserController::class, 'store'])->name('user.store');
            Route::get('/user/{username}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/user/{username}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/user/{username}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::get('/user/{username}/edit-password', [AdminUserController::class, 'editPassword'])->name('user.edit.password');
            Route::put('/user/{username}/update-password', [AdminUserController::class, 'updatePasswordOnly'])->name('user.update.password');

            // CRUD Nilai
            Route::get('/nilai', [AdminNilaiController::class, 'index'])->name('nilai.index');
            Route::get('/nilai/create', [AdminNilaiController::class, 'create'])->name('nilai.create');
            Route::post('/nilai', [AdminNilaiController::class, 'store'])->name('nilai.store');
            Route::get('/nilai/{nis}/{kode}/edit', [AdminNilaiController::class, 'edit'])->name('nilai.edit');
            Route::put('/nilai/{nis}/{kode}', [AdminNilaiController::class, 'update'])->name('nilai.update');
            Route::delete('/nilai/{nis}/{kode}', [AdminNilaiController::class, 'destroy'])->name('nilai.destroy');
            Route::post('/nilai/export', [AdminNilaiController::class, 'export'])->name('nilai.export');

            // CRUD Mapel
            Route::get('/mapel', [AdminMapelController::class, 'index'])->name('mapel.index');
            Route::get('/mapel/create', [AdminMapelController::class, 'create'])->name('mapel.create');
            Route::post('/mapel', [AdminMapelController::class, 'store'])->name('mapel.store');
            Route::get('/mapel/{kode}/edit', [AdminMapelController::class, 'edit'])->name('mapel.edit');
            Route::put('/mapel/{kode}', [AdminMapelController::class, 'update'])->name('mapel.update');
            Route::delete('/mapel/{kode}', [AdminMapelController::class, 'destroy'])->name('mapel.destroy');
            Route::post('/mapel/export', [AdminMapelController::class, 'export'])->name('mapel.export');

            // Aktivitas Terakhir
            Route::get('/activity-logs', [AdminActivityLogController::class, 'index'])->name('activity_logs.index');
        });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});