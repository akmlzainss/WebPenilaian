<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MuridUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route untuk login (tidak perlu autentikasi)
Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');

// Route yang memerlukan autentikasi dengan Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Route untuk logout
    Route::post('/logout', [AuthController::class, 'apiLogout'])->name('api.logout');

    // Route untuk mengambil data nilai
    Route::get('/nilai', [MuridUserController::class, 'apiNilai'])->name('api.nilai');

    // Route untuk debugging (opsional)
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');
});