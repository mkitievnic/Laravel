<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursoFuncionRequest;
use App\Http\Requests\UpdateCursoFuncionRequest;
use App\Models\Curso;
use App\Models\CursoFuncion;
use App\Repositories\CursoFuncionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CursoFuncionController extends AppBaseController
{
    /** @var  CursoFuncionRepository */
    private $cursoFuncionRepository;

    public function __construct(CursoFuncionRepository $cursoFuncionRepo)
    {
        $this->cursoFuncionRepository = $cursoFuncionRepo;
    }

    public function store(CreateCursoFuncionRequest $request)
    {
        $input = $request->all();

        if (!$this->estaRegistrado($request->gestion, $request->curso_id, $request->funcion_id)) {
            $cursoFuncion = $this->cursoFuncionRepository->create($input);
            Flash::success('Curso asignado correctamente.');
        } else {
            Flash::Error('El curso ya a sido asignado con anterioridad!.');

        }

        return redirect(route('funcions.show', [$request->funcion_id]));
    }

    public function destroy($id)
    {
        $cursoFuncion = $this->cursoFuncionRepository->find($id);
        $this->cursoFuncionRepository->delete($id);

        Flash::success('Curso Funcion eliminado correctamente.');

        return redirect(route('funcions.show', [$cursoFuncion->funcion]));

    }

    private function estaRegistrado($gestion, $curso_id, $funcion_id)
    {
        return CursoFuncion::whereGestion($gestion)->whereCursoId($curso_id)->whereFuncionId($funcion_id)->count() > 0;
    }

    public function asignarCurso($curso_id, $funcion_id, $gestion)
    {
        if ($this->estaRegistrado($gestion, $curso_id, $funcion_id)) {
            CursoFuncion::whereGestion($gestion)->whereCursoId($curso_id)->whereFuncionId($funcion_id)->delete();
        } else {
            $curso_function = CursoFuncion::create([
                'gestion' => $gestion,
                'curso_id' => $curso_id,
                'funcion_id' => $funcion_id
            ]);
        }

        return response()->json(['res' => true, 'message' => 'Curso asignado/quitado correctamente!']);
    }
}
