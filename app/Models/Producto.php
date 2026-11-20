<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
    'categoria_id',
    'codigo',
    'nombre',
    'descripcion',
    'precio',
    'stock',
    'estado'
];


      public function categoria(): belongsTo
    {
        return $this->belongsTo(Categoria::class, 'Categoria_id');
    }

}
