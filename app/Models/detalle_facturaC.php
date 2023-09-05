<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_facturaC extends Model
{
    use HasFactory;

    protected $table='detalle_facturac';
    protected $primaryKey='id_detallefacturac';
    public $timestamps=false;
    
    protected $fillable = [
        'id_encabezadofacturaC',
        'id_producto',
        'subtotal',
        'cantidad'

    ];
}
