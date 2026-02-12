<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class controladorProductos extends Controller
{
    public function index(){
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create(){
        return view('productos.create');
    }

    public function store(Request $request){
        $new_producto = new Producto();
        $new_producto->nombre = $request->input('nombre');
        $new_producto->descripcion = $request->input('descripcion');
        $new_producto->precio = $request->input('precio');
        $new_producto->save();
        return redirect()->route('productos.index')->with('Aviso', 'Producto creado exitosamente.');
    }

    public function edit($id){
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id){
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->save();
        return redirect()->route('productos.index')->with('Aviso', 'Producto actualizado exitosamente.');
    }

    public function destroy($id){
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('Aviso', 'Producto eliminado exitosamente.');
    }
}
