<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
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
}
