<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Empleado extends Model
{
    use HasFactory;

protected $fillable = [
    'codigo',
    'nombre',
    'email',
    'cargo',
    'fecha_contratacion',
    'estado'
];

    public function pedidos(): hasMany
    {
        return $this->hasMany(Pedido::class, 'Empleado_id');
    }
}
