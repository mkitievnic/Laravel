<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoFuncion extends Model
{
    use SoftDeletes;

    public $table = 'curso_funcion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'gestion',
        'curso_id',
        'funcion_id'
    ];

    public $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public static $rules = [
        'gestion' => 'required|numeric|min:2015|max:2050',
        'curso_id' => 'required',
        'funcion_id' => 'required'
    ];

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'curso_id');
    }

    public function funcion()
    {
        return $this->belongsTo(\App\Models\Funcion::class, 'funcion_id');
    }

    public function materials()
    {
        return $this->hasMany(\App\Models\Material::class, 'curso_funcion_id');
    }
}
