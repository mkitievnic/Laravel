<?php

namespace App\Repositories;

use App\Models\Empleado;
use App\Repositories\BaseRepository;

/**
 * Class EmpleadoRepository
 * @package App\Repositories
 * @version June 26, 2020, 12:00 am -04
*/

class EmpleadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'legajo',
        'ci',
        'expedido',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'foto',
        'alta'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Empleado::class;
    }
}
