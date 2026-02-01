@extends('layouts.main')
@section('contenido')
<div class="container">
    <h1>Bienvenido al Inventario</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Listado de Productos
                    <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm float-end">Agregar nuevo producto</a>
                </div>
                <div class="card-body">
                    @if(session('Aviso'))
                        <div class="alert alert-success">
                            {{ session('Aviso') }}
                        </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Creado</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>{{ $producto->created_at }}</td>
                                    <td>
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary btn-sm btn-">Editar</a>

                                    <td>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
