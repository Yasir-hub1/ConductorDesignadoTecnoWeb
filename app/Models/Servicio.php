<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'servicio';
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',




    ];
    /* relacion uno a mucho */
    public function promociones()
    {
        return $this->hasMany(Promocion::class, 'id_servicio', 'id');
    }

     /* relacion uno a mucho */
     public function solicitarServicios()
     {
         return $this->hasMany(SolicitarServicio::class, 'id_servicio', 'id');
     }
}
