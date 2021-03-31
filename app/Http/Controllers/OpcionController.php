<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOpcionRequest;
use App\Http\Requests\UpdateOpcionRequest;
use App\Models\Opcion;
use App\Repositories\OpcionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OpcionController extends AppBaseController
{
    /** @var  OpcionRepository */
    private $opcionRepository;

    public function __construct(OpcionRepository $opcionRepo)
    {
        $this->opcionRepository = $opcionRepo;
    }

    public function index(Request $request)
    {
        return Opcion::wherePreguntaId($request->pregunta_id)->orderBy('letra')->get();
    }

    public function store(CreateOpcionRequest $request)
    {
        $letra = 'D';
        $opcion = $this->opcionRepository->create(
            ['letra' => $letra, 'respuesta' => 'respuesta ' . $letra, 'es_correcto' => false]
        );

        return ["res" => true, 'message' => 'Opcion agregada correctamente'];
    }

    public function nuevo($pregunta_id)
    {
        $opciones = Opcion::wherePreguntaId($pregunta_id)->max('letra');

        $letra = ++$opciones;
        $opcion = $this->opcionRepository->create(
            ['letra' => $letra, 'respuesta' => 'respuesta ' . $letra, 'es_correcto' => false, 'pregunta_id' => $pregunta_id]
        );

        return ["res" => true, 'message' => 'Opcion agregada correctamente'];
    }

    public function guardarOpcion($respuesta, Opcion $opcion)
    {
        try {
            $opcion->respuesta = $respuesta;
            $opcion->save();
            return ["res" => true, 'message' => 'Respuesta guardada correctamente'];
        }
        catch (\Exception $e)
        {
            return ["res" => false, 'message' => $e->getMessage()];
        }
    }

    public function guardarOpcionCheck(Opcion $opcion)
    {
        try {
            Opcion::wherePreguntaId($opcion->pregunta_id)->update(['es_correcto' => false]);

            $opcion->es_correcto = true;
            $opcion->save();
            return ["res" => true, 'message' => 'Respuesta guardada correctamente'];
        }
        catch (\Exception $e)
        {
            return ["res" => false, 'message' => $e->getMessage()];
        }
    }

    public function destroy($id)
    {
        $this->opcionRepository->delete($id);
        return ["res" => true, 'message' => 'Opcion eliminada correctamente'];
    }
}
