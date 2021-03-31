<?php

namespace App\Repositories;

use App\Models\Evento;
use App\Repositories\BaseRepository;

/**
 * Class EventoRepository
 * @package App\Repositories
 * @version July 7, 2020, 10:02 pm -04
*/

class EventoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_inicial',
        'fecha_final',
        'hora_inicial',
        'hora_final',
        'direccion',
        'esta_abierto',
        'curso_funcion_id',
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
        return Evento::class;
    }
}
