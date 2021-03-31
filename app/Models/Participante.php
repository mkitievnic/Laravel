<?php

namespace App\Models;

use App\Patrones\EstadoEvento;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{
    use SoftDeletes;

    public $table = 'participante';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'examen',
        'final',
        'gestion',
        'evento_id',
        'empleado_id',
        'es_seleccionado',
    ];

    public static $rules = [
        'gestion' => 'required'
    ];

    public $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function getObservacionAttribute()
    {
        if ($this->evento->estado === EstadoEvento::Finalizado && !is_null($this->final)) {
            return $this->final >= 75 ? "Aprobado" : "Reprobado";
        }
        if ($this->evento->estado === EstadoEvento::EnEjecucion) {
            return "En curso";
        }
        return "";
    }

    public function getAsistioAttribute()
    {
        if ($this->evento->estado === EstadoEvento::Finalizado && !is_null($this->examen)) {
            return "Si";
        }
        if ($this->evento->estado === EstadoEvento::EnEjecucion) {
            return "En curso";
        }
        return "No";
    }

    public function getSeguimientoAttribute()
    {
        if ($this->evento->estado === EstadoEvento::Finalizado) {
            if ($this->observacion === "Aprobado") {
                if ($this->evento->estaVigente === "Vigente")
                    return ["res" => 1, "data" => "<span style='color: green'>OK</span> <br><sub>" . date("d/m/Y", strtotime($this->evento->fecha_caducidad)) . "</sub>"];
                else
                    return ["res" => 2, "data" => "<span style='color: yellow'>Vdo</span> <br><sub>" . date("d/m/Y", strtotime($this->evento->fecha_caducidad)) . "</sub>"];
            } else
                return ["res" => 4, "data" => "<span style='color: red'>Pdte *</span>"];
        } elseif ($this->evento->estado === EstadoEvento::EnEjecucion)
            return ["res" => 3, "data" => "<i>En <br> curso</i>"];
        else
            return ["res" => 4, "data" => "<span style='color: red'>Pdte -</span>"];
    }

    public function getAVencerAttribute()
    {
        if ($this->evento->estado === EstadoEvento::Finalizado) {
            if ($this->observacion === "Aprobado") {
                if ($this->evento->estaVigente === "Vigente")
                    return ["res" => 1, "data" => "<span style='color: green'>OK</span> <br><sub>" . date("d/m/Y", strtotime($this->evento->fecha_caducidad)) . "</sub>"];
                else
                    return ["res" => 2, "data" => "<span style='color: yellow'>Vdo</span> <br><sub>" . date("d/m/Y", strtotime($this->evento->fecha_caducidad)) . "</sub>"];
            } else
                return ["res" => 4, "data" => "<span style='color: red'>M</span>"];
        } elseif ($this->evento->estado === EstadoEvento::EnEjecucion)
            return ["res" => 3, "data" => "<i>C</i> <br><sub>" . date("d/m/Y", strtotime($this->evento->fecha_caducidad)) . "</sub>"];
        else
            return ["res" => 4, "data" => "<span style='color: red'>M</span>"];
    }

    public function evento()
    {
        return $this->belongsTo(\App\Models\Evento::class, 'evento_id');
    }

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'empleado_id');
    }

    public function certificados()
    {
        return $this->hasMany(\App\Models\Certificado::class, 'participante_id');
    }

    public function respuesta()
    {
        return $this->hasMany(\App\Models\Respuestum::class, 'participante_id');
    }
}
