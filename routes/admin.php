<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [DashboardController::class, 'showLogin'])->name('login');
    Route::post('/login', [DashboardController::class, 'login']);
    
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/applications', [DashboardController::class, 'applications'])->name('applications');
        Route::get('/applications/{id}', [DashboardController::class, 'showApplication'])->name('applications.show');
        Route::post('/applications/{id}', [DashboardController::class, 'updateStatus'])->name('applications.update');
    });
});