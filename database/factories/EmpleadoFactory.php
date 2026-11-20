<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**php
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
               'codigo' => fake()->unique()->numerify('EMP-####'),
            'nombre' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cargo' => fake()->randomElement([
                'Administrador',
                'Vendedor',
                'Gerente',
                'Asistente'
            ]),
            'fecha_contratacion' => fake()->dateTimeBetween(
                '-5 years',
                'now'
            )->format('Y-m-d'),
            'estado' => fake()->randomElement([
                'activo',
                'inactivo'
            ]),
        ];
        
    }
}
