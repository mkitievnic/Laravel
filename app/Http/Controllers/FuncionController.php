<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFuncionRequest;
use App\Http\Requests\UpdateFuncionRequest;
use App\Models\Curso;
use App\Models\CursoFuncion;
use App\Models\Funcion;
use App\Repositories\FuncionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FuncionController extends AppBaseController
{
    /** @var  FuncionRepository */
    private $funcionRepository;

    public function __construct(FuncionRepository $funcionRepo)
    {
        $this->funcionRepository = $funcionRepo;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $sector_id = 1;
        if (!$request->has('sector')) {
            $funcions = Funcion::whereSectorId($sector_id)->orderBy('sector_id');
        } else {

            if (isset($input) && !is_null($request->sector))
                $funcions = Funcion::whereSectorId($request->sector)->orderBy('sector_id');
            else
                $funcions = Funcion::orderBy('sector_id');
        }
        $funcions = $funcions->where('nombre', 'ilike', '%' . $request->txtFuncion . '%')->get();

        $cursos = Curso::orderBy('id')->whereEstado(true)->get();
        $gestion = isset($request->gestion) ? $request->gestion : date("Y");

        return view('funcions.index', compact('funcions', 'cursos', 'gestion'));
    }

    public function create()
    {
        return view('funcions.create');
    }

    public function store(CreateFuncionRequest $request)
    {
        $input = $request->all();

        $funcion = $this->funcionRepository->create($input);

        Flash::success('Funcion guardado correctamente.');

        return redirect(route('funcions.index'));
    }

    public function show($id)
    {
        $funcion = $this->funcionRepository->find($id);
        $cursoFunciones = CursoFuncion::whereFuncionId($id)->orderBy('gestion', 'desc')->get();

        if (empty($funcion)) {
            Flash::error('Funcion no encontrado');

            return redirect(route('funcions.index'));
        }

        return view('funcions.show', compact('funcion', 'cursoFunciones'));
    }

    public function edit($id)
    {
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            Flash::error('Funcion no encontrado');

            return redirect(route('funcions.index'));
        }

        return view('funcions.edit')->with('funcion', $funcion);
    }

    public function update($id, UpdateFuncionRequest $request)
    {
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            Flash::error('Funcion no encontrado');

            return redirect(route('funcions.index'));
        }

        $funcion = $this->funcionRepository->update($request->all(), $id);

        Flash::success('Funcion modificado correctamente.');

        return redirect(route('funcions.index'));
    }

    public function destroy($id)
    {
        $funcion = $this->funcionRepository->find($id);

        if (empty($funcion)) {
            Flash::error('Funcion no encontrado');

            return redirect(route('funcions.index'));
        }

        $this->funcionRepository->delete($id);

        Flash::success('Funcion eliminado correctamente.');

        return redirect(route('funcions.index'));
    }
}
