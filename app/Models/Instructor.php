<?php

namespace App\Models;

use App\Rules\PhoneNumber;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;
    public $table = 'instructor';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ci',
        'expedido',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'proveedor_id'
    ];

    public static function rules($isNew = true)
    {
        $ruleEmail = ($isNew ? '' : ',' .request('instructor'));
        $ruleUpdate = ($isNew ? '' : ',' .request('instructor'));
        return [
            'ci' => 'required|min:5|max:10',
            'expedido' => 'required',
            'nombre' => 'required|min:3|max:30',
            'apellido_paterno' => 'required|min:3|max:30',
            'email' => 'required|email|unique:instructor,email' . $ruleEmail,
            'telefono' => ['required','unique:empleado,telefono' . $ruleUpdate, new PhoneNumber()],
            'proveedor_id' => 'required',
        ];
    }

    public function getNombreCompletoAttribute()
    {
        return sprintf("%s %s %s", $this->nombre, $this->apellido_paterno, $this->apellido_materno);
    }

    public function getInformacionAttribute()
    {
        return sprintf("%s %s %s <small class='pull-right'>%s</small>", $this->nombre, $this->apellido_paterno, $this->apellido_materno, $this->proveedor->nombre);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function usuario()
    {
        return $this->morphOne(\App\User::class, 'persona');
    }
}
