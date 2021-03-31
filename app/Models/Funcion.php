<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcion extends Model
{
    use SoftDeletes;
    public $table = 'funcion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'sector_id'
    ];

    public $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public static $rules = [
        'nombre' => 'required|min:3|max:100',
        'sector_id' => 'required'
    ];

    public $appends = ['informacion'];
    public function getInformacionAttribute(){
        return sprintf("%s   <small class='pull-right'>%s</small>", $this->nombre, $this->sector->nombre);
    }

    public function sector()
    {
        return $this->belongsTo(\App\Models\Sector::class, 'sector_id');
    }

    public function cursoFuncions()
    {
        return $this->hasMany(\App\Models\CursoFuncion::class, 'funcion_id');
    }

    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'funcion_id');
    }
}
