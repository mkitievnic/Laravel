<?php

namespace App\Repositories;

use App\Models\CursoFuncion;
use App\Repositories\BaseRepository;

/**
 * Class CursoFuncionRepository
 * @package App\Repositories
 * @version June 26, 2020, 11:28 pm -04
*/

class CursoFuncionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alta',
        'curso_id',
        'funcion_id'
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
        return CursoFuncion::class;
    }
}
