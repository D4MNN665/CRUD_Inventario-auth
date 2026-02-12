<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\controladorProductos;
use App\Models\Producto;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_crearProducto()
    {
        $controller = new controladorProductos();
        $response = $controller->create();

        // Verificar que retorna una Vista
        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
    }

    public function test_guardarProducto()
    {
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'nombre' => 'Producto Test',
            'descripcion' => 'Descripción test',
            'precio' => 99.99
        ]);

        $controller = new controladorProductos();
        $response = $controller->store($request);

        // Verificar que el producto fue creado usando el modelo
        $producto = Producto::where('nombre', 'Producto Test')->first();
        $this->assertNotNull($producto);
        $this->assertEquals('Descripción test', $producto->descripcion);
        $this->assertEquals(99.99, $producto->precio);
    }
}