<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\BaseRepository;

/**
 * Class MaterialRepository
 * @package App\Repositories
 * @version June 26, 2020, 11:29 pm -04
*/

class MaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion',
        'url',
        'curso_funcion_id'
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
        return Material::class;
    }
}
