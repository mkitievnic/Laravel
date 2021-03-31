<?php

namespace App\Models;

use App\Rules\PhoneNumber;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    public $table = 'empleado';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'legajo',
        'ci',
        'expedido',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'telefono',
        'email',
        'foto',
        'funcion_id',
        'proveedor_id'
    ];

    public static function rules($isNew = true) {
        $ruleUpdate = ($isNew ? '' : ',' .request('empleado'));
        $ruleEmail = ($isNew ? '' : ',' .request('empleado'));
        $ruleTelefono = ($isNew ? '' : ',' .request('empleado'));

        return [
            'legajo' => 'required|numeric|min:0|max:99999|unique:empleado,legajo' . $ruleUpdate,
            'ci' => 'required|min:5|max:10',
            'expedido' => 'required',
            'nombre' => 'required|min:3|max:20',
            'apellido_paterno' => 'required|min:2|max:15',
            'apellido_materno' => 'min:2|max:15',
            'email' => 'required|email|unique:empleado,email' . $ruleEmail,
            'telefono' => ['required','unique:empleado,telefono' . $ruleTelefono, new PhoneNumber()],
            'proveedor_id' => 'required',
            'fecha_nacimiento' => 'required'
        ];
    }

    public $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function getNombreCompletoAttribute(){
        return sprintf("%s %s %s", $this->nombre, $this->apellido_paterno, $this->apellido_materno);
    }

    public function getInformacionAttribute()
    {
        return sprintf("%s %s %s <small class='pull-right'>Legajo: %s</small>", $this->nombre, $this->apellido_paterno, $this->apellido_materno, $this->legajo);
    }

    public function conductorHabilitado($curso_id)
    {
        $leCorresponde = $this->funcion->cursoFuncions->where('curso_id', $curso_id)->count() > 0;
        if($leCorresponde)
        {
            $evento = $this->participantes()->whereHas('evento', function($q) use ($curso_id) {
                $q->where('curso_id', $curso_id);
            })->orderByDesc('id')->first();

            if(!is_null($evento))
                return $evento->estaVigente;
            else
                return 'Pdte';
        }
        else
            return '-';
    }

    public function usuario()
    {
        return $this->morphOne(\App\User::class, 'persona');
    }

    public function funcion(){
        return $this->belongsTo(Funcion::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function diasFranco(){
        return $this->hasMany(DiaFranco::class);
    }

    public function participantes(){
        return $this->hasMany(Participante::class, 'empleado_id')->orderBy('id', 'desc');
    }
}
