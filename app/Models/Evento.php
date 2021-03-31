<?php

namespace App\Models;

use App\Patrones\EstadoEvento;
use App\Patrones\Fachada;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;

    public $table = 'evento';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'fecha_inicial',
        'fecha_final',
        'hora_inicial',
        'hora_final',
        'fecha_caducidad',
        'direccion',
        'estado',
        'curso_id',
        'usuario_id',
    ];

    public static $rules = [
        'fecha_inicial' => 'required',
        'fecha_final' => 'required',
        'direccion' => 'required|min:5|max:200',
        'curso_id' => 'required',
        'usuario_id' => 'required'
    ];

    public $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public static $cast = [
        'fecha_inicial' => 'date',
        'fecha_final' => 'date',
        'fecha_caducidad' => 'date',
    ];

    public function getEstaVigenteAttribute()
    {
        if (Fachada::getDateServer() <= Fachada::setDate($this->fecha_caducidad)) {
            return "Vigente";
        }
        return "Caducado";
    }

    public function getEsEscrituraAttribute(){
        return $this->estado === EstadoEvento::Pendiente || $this->estado === EstadoEvento::EnEjecucion;
    }


//    public $with = ['examen'];
    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'curso_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\User::class, 'usuario_id');
    }

    public function participantes()
    {
        return $this->hasMany(\App\Models\Participante::class, 'evento_id');
    }

    public function examen()
    {
        return $this->hasOne(\App\Models\Examen::class, 'evento_id');
    }
}
