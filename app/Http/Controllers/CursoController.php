<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Models\Curso;
use App\Repositories\CursoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CursoController extends AppBaseController
{
    /** @var  CursoRepository */
    private $cursoRepository;

    public function __construct(CursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

        $cursos = Curso::where('codigo', 'ilike', '%' . $txtBuscar . '%')
                        ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
                        ->orderBy('id')->get();

        return view('cursos.index')
            ->with('cursos', $cursos);
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(CreateCursoRequest $request)
    {
        $input = $request->all();

        $curso = $this->cursoRepository->create($input);

        Flash::success('Curso guardado correctamente.');

        return redirect(route('cursos.index'));
    }

    public function show($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no encontrado');

            return redirect(route('cursos.index'));
        }

        return view('cursos.show')->with('curso', $curso);
    }

    public function edit($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no encontrado');

            return redirect(route('cursos.index'));
        }

        return view('cursos.edit')->with('curso', $curso);
    }

    public function update($id, UpdateCursoRequest $request)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no encontrado');

            return redirect(route('cursos.index'));
        }

        $curso = $this->cursoRepository->update($request->all(), $id);

        Flash::success('Curso modificado correctamente.');

        return redirect(route('cursos.index'));
    }

    public function destroy($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no encontrado');

            return redirect(route('cursos.index'));
        }

        $this->cursoRepository->delete($id);

        Flash::success('Curso eliminado correctamente.');

        return redirect(route('cursos.index'));
    }
}
