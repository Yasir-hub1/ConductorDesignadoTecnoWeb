<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Cliente extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cliente';
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


    ];

      /* relacion uno a mucho */
      public function solicitarServicios()
      {
          return $this->hasMany(SolicitarServicio::class, 'id_cliente', 'id');
      }
}
