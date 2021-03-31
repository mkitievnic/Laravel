<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use SoftDeletes;
    public $table = 'sector';

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

    public $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    public function funcions()
    {
        return $this->hasMany(\App\Models\Funcion::class, 'sector_id');
    }
}
