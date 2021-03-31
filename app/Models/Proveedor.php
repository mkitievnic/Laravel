<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    public $table = 'proveedor';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre'
    ];


    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    public static $rules = [
        'nombre' => 'required|min:3|max:100'
    ];

    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'proveedor_id');
    }

    public function instructors()
    {
        return $this->hasMany(\App\Models\Instructor::class, 'proveedor_id');
    }
}
