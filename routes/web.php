<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InformasiController as AdminInformasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\InformasiController as UserInformasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Login (satu halaman untuk admin dan user)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');


// Login (satu halaman untuk admin dan user)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Khusus admin: dashboard + CRUD informasi
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('informasi', AdminInformasiController::class)
        ->parameters(['informasi' => 'informasi']);
});

// Khusus user: hanya membaca informasi
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/informasi', [UserInformasiController::class, 'index'])->name('index');
    Route::get('/informasi/{id}', [UserInformasiController::class, 'show'])->name('show');
});