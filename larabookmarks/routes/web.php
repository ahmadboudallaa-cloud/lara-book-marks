<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LinkController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','is_active'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CATEGORIES
    Route::resource('categories', CategoryController::class);

    // LINKS
Route::resource('links', LinkController::class)->except(['show']);

    // SEARCH
    Route::get('/links/search', [LinkController::class, 'search'])->name('links.search');
});

require __DIR__.'/auth.php';
