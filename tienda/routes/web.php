<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use Illuminate\Http\Request;

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

    Route::get('/productos',function(){
    $productos = Producto::all();
    return view('productos.index', compact('productos'));
    }) ->name('productos.index');

    Route::get('/productos/create',function(){
    return view('productos.create');
    }) ->name('productos.create');

    Route::post('/productos', function (Request $request) {
    $new_producto = new Producto();
    $new_producto->nombre = $request->input('nombre');
    $new_producto->descripcion = $request->input('descripcion');
    $new_producto->precio = $request->input('precio');
    $new_producto->save();
    return redirect()->route('productos.index')->with('Aviso', 'Producto creado exitosamente.');

    }) ->name('productos.store');

    Route::delete('/productos/{id}', function ($id) {
    $producto = Producto::findOrFail($id);
    $producto->delete();
    return redirect()->route('productos.index')->with('Aviso', 'Producto eliminado exitosamente.');
    }) ->name('productos.destroy');


    Route::get('productos/{id}/edit', function ($id) {
    $producto = Producto::findOrFail($id);
    return view('productos.edit', compact('producto'));
    }) ->name('productos.edit');

    Route::put('/productos/{id}', function (Request $request, $id) {
    $producto = Producto::findOrFail($id);
    $producto->nombre = $request->input('nombre');
    $producto->descripcion = $request->input('descripcion');
    $producto->precio = $request->input('precio');
    $producto->save();
    return redirect()->route('productos.index')->with('Aviso', 'Producto actualizado exitosamente.');
    }) ->name('productos.update');



});

require __DIR__.'/auth.php';
