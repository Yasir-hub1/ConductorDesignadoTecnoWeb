<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Conductor extends Authenticatable
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
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_conductor', 'id');
    }


      /* relacion uno a mucho */
      public function solicitarServicios()
      {
          return $this->hasMany(SolicitarServicio::class, 'id_conductor', 'id');
      }
}
