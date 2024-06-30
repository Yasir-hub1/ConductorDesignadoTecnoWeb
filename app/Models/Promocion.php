<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'promocion';
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'descuento',
        'id_servicio',



    ];
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id');
    }
}
