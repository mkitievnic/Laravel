<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{
    use SoftDeletes;

    public $table = 'pregunta';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'pregunta',
        'estado',
        'curso_id'
    ];

    public static $rules = [
        'pregunta' => 'required|min:10'
    ];

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'curso_id');
    }

    public function opcions()
    {
        return $this->hasMany(\App\Models\Opcion::class, 'pregunta_id');
    }

}
