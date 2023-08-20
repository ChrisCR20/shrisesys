<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;

    protected $table='medida';
    protected $primaryKey='id_medida';
    public $timestamps=false;
    
    protected $fillable = [
        'nombremedida',

    ];
}
