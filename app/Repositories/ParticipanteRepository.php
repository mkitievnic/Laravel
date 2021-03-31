<?php

namespace App\Repositories;

use App\Models\Participante;
use App\Repositories\BaseRepository;

/**
 * Class ParticipanteRepository
 * @package App\Repositories
 * @version July 14, 2020, 11:48 pm -04
*/

class ParticipanteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'asistencia',
        'examen',
        'final',
        'gestion',
        'evento_id',
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
        return Participante::class;
    }
}
