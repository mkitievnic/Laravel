<?php

namespace App\Models;

use App\Patrones\EstadoEvento;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuesta extends Model
{
    public $table = 'respuesta';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'fecha',
        'letra',
        'es_correcto',
        'participante_id',
        'pregunta_id',
        'examen_id',
    ];

    public $hidden = [
      'created_at', 'updated_at'
    ];
}
