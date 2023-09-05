<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    
    protected $table='producto';
    protected $primaryKey='id_producto';
    public $timestamps=false;
    
    protected $fillable = [
        'cantidad',
        'nombreproducto',
        'id_marca',
        'id_medida',
        'id_categoria',
        'codigoproducto',
        'codigobarras',
        'precio_costo',
        'precio_venta'

    ];
}
