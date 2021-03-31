<?php

namespace App\Repositories;

use App\Models\Examen;
use App\Repositories\BaseRepository;

/**
 * Class ExamenRepository
 * @package App\Repositories
 * @version July 25, 2020, 10:35 pm -04
*/

class ExamenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_inicial',
        'descripcion',
        'tiempo',
        'estado',
        'evento_id',
        'fecha_final'
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
        return Examen::class;
    }
}
