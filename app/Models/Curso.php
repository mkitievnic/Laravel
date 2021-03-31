<?php

namespace App\Models;

use App\Patrones\Fachada;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;

    public $table = 'curso';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'codigo',
        'nombre',
        'duracion',
        'vencimiento',
        'contenido',
        'estado'
    ];

    public $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public static function rules($isNew = true)
    {
        $ruleUpdate = ($isNew ? '' : ',' . request('curso'));
        return [
            'codigo' => 'required|min:4|max:8|unique:curso,codigo' . $ruleUpdate,
            'nombre' => 'required|min:3|max:150',
            'duracion' => 'required|numeric|min:1|max:9999',
            'vencimiento' => 'required|numeric|min:1|max:10',
            'contenido' => 'min:10',
            'estado' => 'required'
        ];
    }

    public function getInformacionAttribute()
    {
        return sprintf("%s | %s", $this->codigo, $this->nombre);
    }

    public static function participantes($curso_id, $fecha)
    {
        $cursoFunciones = CursoFuncion::with(['funcion', 'funcion.empleados'])->whereCursoId($curso_id)
            ->whereGestion(date('Y', strtotime($fecha)))
            ->whereHas('funcion.empleados.diasFranco', function ($q) use ($fecha) {
                $q->whereFecha($fecha);
            })->get();

        $total = 0;
        foreach ($cursoFunciones as $row) {
            $total += $row->funcion->empleados->count();
        }
        return $total;
    }

    public static function aprobados($curso_id)
    {
        $fechaActual = Fachada::getDateServer();
        $participantes = Participante::whereHas('evento',  function ($q) use ($curso_id, $fechaActual) {
            $q->whereCursoId($curso_id)->where('fecha_caducidad', '>=',  $fechaActual);
        })->where('final', '>=', 75)->count();

        $total = $participantes;
        return $total;
    }
    public static function totales($curso_id)
    {
        $cursoFunciones = CursoFuncion::with(['funcion', 'funcion.empleados'])->whereCursoId($curso_id)
            ->whereGestion(date('Y'))
            ->get();

        $total = 0;
        foreach ($cursoFunciones as $row) {
            $total += $row->funcion->empleados->count();
        }
        return $total;
    }

    public function cursoFuncions()
    {
        return $this->hasMany(\App\Models\CursoFuncion::class, 'curso_id');
    }
}
