<?php

namespace App\Repositories;

use App\Models\Funcion;
use App\Repositories\BaseRepository;

/**
 * Class FuncionRepository
 * @package App\Repositories
 * @version June 26, 2020, 11:28 pm -04
*/

class FuncionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'sector_id'
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
        return Funcion::class;
    }
}
