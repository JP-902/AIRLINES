<?php
  
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Pedido extends Model
{
    use HasFactory;

     protected $fillable = [
        'cliente_id',
        'empleado_id',
        'numero_pedido',
        'fecha_pedido',
        'fecha_entrega',
        'total',
        'estado',
        'observaciones'
    ];

    public function cliente(): belongsTo
    {
        return $this->belongsTo(Cliente::class, 'Cliente_id');
    }

    public function empleado(): belongsTo
    {
        return $this->belongsTo(Empleado::class, 'Empleado_id');
    }

}
