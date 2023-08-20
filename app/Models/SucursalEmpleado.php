<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SucursalEmpleado extends Model
{
    use HasFactory;

    
    protected $table='sucursal_empleado';
     protected $primaryKey='id_persona';
    public $timestamps=false;
    
    protected $fillable = [
        'id_sucursal',
        'id_empleado',

    ];
}
