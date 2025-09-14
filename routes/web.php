<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','throttle:60,1'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','throttle:60,1'])->group(function () {
    Route::get('/urls', [UrlController::class, 'index'])->name('urls.index');
    Route::get('/urls/create', [UrlController::class, 'create'])->name('urls.create');
    Route::post('/urls', [UrlController::class, 'store'])->name('urls.store');
    Route::get('/urls/{url}/edit', [UrlController::class, 'edit'])->name('urls.edit');
    Route::put('/urls/{url}', [UrlController::class, 'update'])->name('urls.update');
    Route::delete('/urls/{url}', [UrlController::class, 'destroy'])->name('urls.destroy');
});

Route::get('/b/{shortKey}', [UrlController::class, 'redirect'])->middleware('throttle:30,1')->name('url.redirect');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
