<?php

namespace App;

use App\Models\Empleado;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "usuario";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'nivel', 'alta', 'persona_id', 'persona_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $appends = ['es_empleado'];
    public function getEsEmpleadoAttribute(){
        return isset($this->persona->legajo);
    }

    public static $rules = [];

    public function hasNiveles(array $niveles)
    {
        foreach ($niveles as $nivel) {
            if ($this->nivel === $nivel) {
                return true;
            }
        }
        return false;
    }

    public function persona()
    {
        return $this->morphTo();
    }
}
