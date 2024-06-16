<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'personal';
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
        'salario',
        'estado',
        'cargo',
       
       
        
    ];
}
