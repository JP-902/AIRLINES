<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Empleado;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Bodega;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClienteSeeder::class,
            EmpleadoSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            PedidoSeeder::class,
            BodegaSeeder::class,
        ]);
    }
}
