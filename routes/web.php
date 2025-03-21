<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('berita')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/{id}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::get('/search', [BeritaController::class, 'search'])->name('berita.search');

    // admin
    // Route::prefix('admin')->group(function () {
    //     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // });
});
