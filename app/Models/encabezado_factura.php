<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encabezado_factura extends Model
{
    use HasFactory;

    protected $table='encabezado_factura';
    protected $primaryKey='id_encabezadof';
    public $timestamps=false;
    
    protected $fillable = [
        'id_cliente',
        'id_tipopago',
        'id_sucursal',
        'montototal',
        'id_caja',
        'fecha'

    ];
}
