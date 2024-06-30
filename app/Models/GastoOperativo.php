<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoOperativo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'gasto_operativo';
    protected $fillable = [
        'monto',
        'fecha',
        'descripcion',
        'id_personal',



    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'id_personal', 'id');
    }
}
