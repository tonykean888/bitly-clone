<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/urls', [AdminController::class, 'urls'])->name('admin.urls');
    Route::get('/urls/{url}/edit', [AdminController::class, 'editUrl'])->name('admin.urls.edit');
    Route::put('/urls/{url}', [AdminController::class, 'updateUrl'])->name('admin.urls.update');
    Route::delete('/urls/{url}', [AdminController::class, 'deleteUrl'])->name('admin.urls.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});


Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');
});

