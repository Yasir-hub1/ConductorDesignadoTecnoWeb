<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transacciones extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transacciones';
    protected $fillable = [
        'id_solicitar',
        'fecha',
        'monto',
        'estado',
        'id_metodo',



    ];
    public function metodoPago()
    {
        return $this->belongsTo(MetodoDePago::class, 'id_metodo');
    }

    public function solicitarServicio()
    {
        return $this->belongsTo(SolicitarServicio::class, 'id_solicitar');
    }

}
