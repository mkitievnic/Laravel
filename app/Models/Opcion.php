<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opcion extends Model
{
    use SoftDeletes;

    public $table = 'opcion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'letra',
        'respuesta',
        'es_correcto',
        'pregunta_id'
    ];

    public $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public static $rules = [
        'letra' => 'required',
        'respuesta' => 'required',
        'es_correcto' => 'required'
    ];

    public function pregunta()
    {
        return $this->belongsTo(\App\Models\Pregunta::class, 'pregunta_id');
    }
}
