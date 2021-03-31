<?php

namespace App\Repositories;

use App\Models\DiaFranco;
use App\Repositories\BaseRepository;

/**
 * Class DiaFrancoRepository
 * @package App\Repositories
 * @version June 29, 2020, 11:37 pm -04
*/

class DiaFrancoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'empleado_id'
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
        return DiaFranco::class;
    }
}
