<?php

namespace App\Repositories;

use App\Models\PreguntaFrecuente;
use App\Repositories\BaseRepository;

/**
 * Class PreguntaFrecuenteRepository
 * @package App\Repositories
 * @version September 1, 2020, 11:46 pm -04
*/

class PreguntaFrecuenteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pregunta',
        'respuesta',
        'usuario_id'
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
        return PreguntaFrecuente::class;
    }
}
