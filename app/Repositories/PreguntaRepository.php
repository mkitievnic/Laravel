<?php

namespace App\Repositories;

use App\Models\Pregunta;
use App\Repositories\BaseRepository;

/**
 * Class PreguntaRepository
 * @package App\Repositories
 * @version July 23, 2020, 6:51 pm -04
*/

class PreguntaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pregunta',
        'url_imagen',
        'estado',
        'curso_id'
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
        return Pregunta::class;
    }
}
