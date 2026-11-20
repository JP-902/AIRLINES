<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Cliente extends Model
{
    use HasFactory;

      protected $fillable = ['nombre', 'email', 'telefono', 'direccion','estado','codigo'];

    public function pedidos(): hasMany
    {
        return $this->hasMany(Pedido::class, 'Cliente_id');
    }
}
