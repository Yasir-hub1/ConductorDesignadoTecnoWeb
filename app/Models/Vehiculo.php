<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vehiculo';
    protected $fillable = [
        'modelo',
        'marca',
        'placa',
        'numero_de_seguro',
        'fecha_vencimiento_seguro',
        'estado',
        'id_conductor',



    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id');
    }
}
