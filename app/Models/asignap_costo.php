<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignap_costo extends Model
{
    use HasFactory;
    protected $table='presentacion_costo';
    protected $primaryKey='id';
    public $timestamps=false;
    
    protected $fillable = [
        'id_medida',
        'precio_costo'

    ];
}
