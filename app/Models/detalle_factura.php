<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_factura extends Model
{
    use HasFactory;

    protected $table='detalle_factura';
    protected $primaryKey='id_detallef';
    public $timestamps=false;
    
    protected $fillable = [
        'id_encabezadof',
        'id_producto',
        'cantidad',
        'subtotal'

    ];
}
