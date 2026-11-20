<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaPedido = fake()->dateTimeBetween('-1 year', 'now');

        return [
             'cliente_id' => Cliente::query()
                ->inRandomOrder()
                ->value('id') ?? Cliente::factory(),

            'empleado_id' => Empleado::query()
                ->inRandomOrder()
                ->value('id') ?? Empleado::factory(),

            'numero_pedido' => fake()->unique()->numerify('PED-####'),
            'fecha_pedido' => $fechaPedido->format('Y-m-d'),

            'fecha_entrega' => fake()->optional(0.7)
                ->dateTimeBetween(
                    $fechaPedido,
                    '+2 months'
                )?->format('Y-m-d'),

            'total' => fake()->randomFloat(2, 0, 50000),

            'estado' => fake()->randomElement([
                'pendiente',
                'en_proceso',
                'completado',
                'cancelado'
            ]),

            'observaciones' => fake()->optional()->sentence(),
        ];
    }
}
