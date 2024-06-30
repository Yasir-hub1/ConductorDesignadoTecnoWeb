<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoDePago extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'metodo_de_pago';
    protected $fillable = [
        'tipo_de_metodo_de_pago',
        'numero_tarjeta',
        'nombre_en_la_tarjeta',
        'fecha_vencimiento',
        'cvv_cvc',
        'fecha_de_nacimiento',
        'id_cliente',



    ];
    public function transacciones()
    {
        return $this->hasMany(transacciones::class, 'id_metodo');
    }
}
