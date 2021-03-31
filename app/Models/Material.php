<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    public $table = 'material';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'descripcion',
        'url',
        'curso_id'
    ];

    public $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public static $rules = [
        'descripcion' => 'required|min:5|max:250',
        'url' => 'required|min:3',
        'curso_id' => 'required'
    ];

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'curso_id');
    }
}
