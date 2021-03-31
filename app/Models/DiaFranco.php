<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaFranco extends Model
{
    use SoftDeletes;

    public $table = 'dia_franco';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'fecha',
        'empleado_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'empleado_id' => 'integer'
    ];

    public static $rules = [
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'empleado_id');
    }
}
