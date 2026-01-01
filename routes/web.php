<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\User\UserAgendaController;
use App\Http\Controllers\ProfileController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('agendas', AgendaController::class);
    Route::patch('/agendas/{agenda}/cancel', [AgendaController::class, 'cancel'])->name('agendas.cancel');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'printPdf'])->name('laporan.pdf');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard');
    Route::get('/agendas', [UserAgendaController::class, 'index'])->name('agendas.index');
    Route::get('/agendas/{agenda}', [UserAgendaController::class, 'show'])->name('agendas.show');
    Route::get('/my-agendas', [UserAgendaController::class, 'myAgendas'])->name('agendas.my');
    Route::get('/my-agendas/create', [UserAgendaController::class, 'create'])->name('agendas.create');
    Route::post('/my-agendas', [UserAgendaController::class, 'store'])->name('agendas.store');
    Route::get('/my-agendas/{agenda}/edit', [UserAgendaController::class, 'edit'])->name('agendas.edit');
    Route::put('/my-agendas/{agenda}', [UserAgendaController::class, 'update'])->name('agendas.update');
    Route::delete('/my-agendas/{agenda}', [UserAgendaController::class, 'destroy'])->name('agendas.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});