<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PreguntaFrecuente extends Model
{
    use SoftDeletes;

    public $table = 'pregunta_frecuente';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'pregunta',
        'respuesta',
        'usuario_id'
    ];


    protected $casts = [
        'id' => 'integer',
        'pregunta' => 'string',
        'respuesta' => 'string',
        'usuario_id' => 'integer'
    ];


    public static $rules = [
        'pregunta' => 'required',
        'respuesta' => 'required'
    ];


    public $hidden = [
      'id', 'created_at', 'updated_at', 'deleted_at', 'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id');
    }
}
