<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['Categoria_id', 'nombre','descripcion','estado'];


public function producto(): hasMany
    {
        return $this->hasmany(Producto::class, 'categoria_id');
    }

}
