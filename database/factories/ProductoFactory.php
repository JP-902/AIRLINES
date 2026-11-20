<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'categoria_id' => Categoria::query()
                ->inRandomOrder()
                ->value('id') ?? Categoria::factory(),

            'codigo' => fake()->unique()->numerify('PROD-####'),
            'nombre' => fake()->randomElement([
                'Escritorio de madera',
                'Mesa de comedor',
                'Silla de oficina',
                'Estantería',
                'Armario'
            ]),
            'descripcion' => fake()->sentence(),
            'precio' => fake()->randomFloat(2, 500, 15000),
            'stock' => fake()->numberBetween(0, 100),
            'estado' => fake()->randomElement([
                'activo',
                'inactivo'
            ]),
        ];
    }
}
