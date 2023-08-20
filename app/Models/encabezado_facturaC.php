<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encabezado_facturaC extends Model
{
    use HasFactory;

    protected $table='encabezado_facturac';
    protected $primaryKey='id_encabezadofacturaC';
    public $timestamps=false;
    
    protected $fillable = [
        'id_proveedor',
        'totalcompra',
        'id_tipopago',
        'serie',
        'numerodoctoc'

    ];
}
