<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitarServicio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'solicitar_servicio';
    protected $fillable = [
        'id',
        'fecha_solicitud',
        'fecha_servicio',
        'costo_adicional',
        'origen',
        'destino',
        'estado',
        'tipo_servicio',
        'id_cliente',
        'id_servicio',
        'id_conductor',
        'ruta',




    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id');
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'id_conductor', 'id');
    }

    public function transaccion()
    {
        return $this->hasOne(transacciones::class, 'id_solicitar');
    }
}
