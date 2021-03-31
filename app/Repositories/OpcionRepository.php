<?php

namespace App\Repositories;

use App\Models\Opcion;
use App\Repositories\BaseRepository;

/**
 * Class OpcionRepository
 * @package App\Repositories
 * @version July 23, 2020, 6:51 pm -04
*/

class OpcionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'letra',
        'respuesta',
        'es_correcto',
        'pregunta_id'
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
        return Opcion::class;
    }
}
