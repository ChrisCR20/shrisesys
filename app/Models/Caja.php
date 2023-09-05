<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

        
    protected $table='caja';
    protected $primaryKey='id_caja';
    public $timestamps=false;
    
    protected $fillable = [
        'id_sucursal',
        'fechaapertura',
        'montoinicial',
        'montofinal',
        'fechacierre',
        'id_empleado'

    ];
}
