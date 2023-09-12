<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asigna_precio extends Model
{
    use HasFactory;

    protected $table='presentacion_cliente';
    protected $primaryKey='id_prcl';
    public $timestamps=false;
    
    protected $fillable = [
        'id_cliente',
        'id_presentacion',
        'precio'

    ];
}
