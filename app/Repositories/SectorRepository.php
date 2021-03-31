<?php

namespace App\Repositories;

use App\Models\Sector;
use App\Repositories\BaseRepository;

/**
 * Class SectorRepository
 * @package App\Repositories
 * @version June 26, 2020, 11:28 pm -04
*/

class SectorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
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
        return Sector::class;
    }
}
