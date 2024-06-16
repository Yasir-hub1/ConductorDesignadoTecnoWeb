<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'conductor';
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'password',
        'celular',
        'fecha_de_nacimiento',
        'genero',
        'tipo_usuario',
        'id_rol',
        'ci',
        'numero_de_licencia_de_conducir',
        'tipo_de_licencia',
        'fecha_de_vencimiento_de_la_licencia',
        'estado',


    ];

    /* relacion uno a mucho */
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_conductor');
    }
}
