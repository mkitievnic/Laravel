<?php

namespace App\Models;

use App\Patrones\Fachada;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{
    use SoftDeletes;

    public $table = 'examen';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'fecha_inicial',
        'descripcion',
        'tiempo',
        'estado',
        'evento_id',
        'fecha_final'
    ];

    public static $rules = [
        'fecha_inicial' => 'required',
        'descripcion' => 'required|min:5|max:250',
        'estado' => 'required',
        'tiempo' => 'required|min:1',
        'fecha_final' => 'required'
    ];

    public $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function esExamenTerminado($participante_id)
    {
        return $this->hasMany(\App\Models\Respuesta::class, 'examen_id')->where('participante_id', $participante_id)->count() > 0;
    }

    public function cantRespuestasCorrectas($participante_id)
    {
        return $this->hasMany(\App\Models\Respuesta::class, 'examen_id')->where('participante_id', $participante_id)->where('es_correcto', true)->count();
    }

    public function calificacionParticipante($participante_id)
    {
        $respuestas =  $this->cantRespuestasCorrectas($participante_id);
        return ($respuestas / Fachada::$cantPreguntas) * 100;
    }

    public function evento()
    {
        return $this->belongsTo(\App\Models\Evento::class, 'evento_id');
    }

    public function respuestas()
    {
        return $this->hasMany(\App\Models\Respuesta::class, 'examen_id');
    }
}
