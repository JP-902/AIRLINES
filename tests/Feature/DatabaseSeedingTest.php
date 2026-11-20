<?php

namespace Tests\Feature;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeedingTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_seeders_create_records_with_valid_dependencies(): void
    {
        $this->seed();

        foreach (['categorias', 'clientes', 'empleados', 'productos', 'pedidos'] as $table) {
            $this->assertDatabaseCount($table, 15);
        }

        foreach (Pedido::all() as $pedido) {
            $this->assertDatabaseHas('clientes', ['id' => $pedido->cliente_id]);
            $this->assertDatabaseHas('empleados', ['id' => $pedido->empleado_id]);
            if ($pedido->fecha_entrega !== null) {
                $this->assertGreaterThanOrEqual($pedido->fecha_pedido, $pedido->fecha_entrega);
            }
        }
    }

    public function test_factories_create_dependencies_when_tables_are_empty(): void
    {
        $producto = Producto::factory()->create();
        $pedido = Pedido::factory()->create();

        $this->assertDatabaseHas('categorias', ['id' => $producto->categoria_id]);
        $this->assertDatabaseHas('clientes', ['id' => $pedido->cliente_id]);
        $this->assertDatabaseHas('empleados', ['id' => $pedido->empleado_id]);
    }
}
