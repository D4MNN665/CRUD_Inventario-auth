<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\controladorProductos;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/productos', [controladorProductos::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [controladorProductos::class, 'create'])->name('productos.create');
    Route::post('/productos', [controladorProductos::class, 'store'])->name('productos.store');
    Route::get('productos/{id}/edit', [controladorProductos::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{id}', [controladorProductos::class, 'update'])->name('productos.update');
    Route::delete('/productos/{id}', [controladorProductos::class, 'destroy'])->name('productos.destroy');
});

require __DIR__.'/auth.php';
