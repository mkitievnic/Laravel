<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePreguntaRequest;
use App\Http\Requests\UpdatePreguntaRequest;
use App\Models\Curso;
use App\Models\Pregunta;
use App\Repositories\PreguntaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PreguntaController extends AppBaseController
{
    /** @var  PreguntaRepository */
    private $preguntaRepository;

    public function __construct(PreguntaRepository $preguntaRepo)
    {
        $this->preguntaRepository = $preguntaRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === ""? "%" : $request->txtBuscar;

        $preguntas = Pregunta::where('pregunta', 'ilike', '%' . $txtBuscar . '%')->where('curso_id', $request->curso_id)->orderByDesc('id')->get();
        $curso = Curso::findOrFail($request->curso_id);

        return view('preguntas.index', compact("preguntas", "curso"));
    }

    public function create(Request $request)
    {
        $curso = Curso::findOrFail($request->curso_id);
        return view('preguntas.create', compact('curso'));
    }

    public function store(CreatePreguntaRequest $request)
    {
        $input = $request->all();

        $pregunta = $this->preguntaRepository->create($input);

        $pregunta->opcions()->create(['letra' => 'A', 'respuesta' => 'respuesta A', 'es_correcto' => true]);
        $pregunta->opcions()->create(['letra' => 'B', 'respuesta' => 'respuesta B', 'es_correcto' => false]);
        $pregunta->opcions()->create(['letra' => 'C', 'respuesta' => 'respuesta C', 'es_correcto' => false]);

        Flash::success('Pregunta guardado correctamente');

        return redirect(route('preguntas.edit', [$pregunta]));
    }

    public function edit($id)
    {
        $pregunta = $this->preguntaRepository->find($id);
        $curso = Curso::findOrFail($pregunta->curso_id);


        if (empty($pregunta)) {
            Flash::error('Pregunta no encontrado');
            return redirect(route('preguntas.index'));
        }

        return view('preguntas.edit', compact('curso', 'pregunta'));
    }

    public function update($id, UpdatePreguntaRequest $request)
    {
        $pregunta = $this->preguntaRepository->find($id);

        if (empty($pregunta)) {
            Flash::error('Pregunta no encontrado');

            return redirect(route('preguntas.index'));
        }

        $pregunta = $this->preguntaRepository->update($request->all(), $id);

        Flash::success('Pregunta actualizado correctamente');

        return redirect(route('preguntas.index', ['curso_id' => $pregunta->curso_id]));
    }

    public function destroy($id)
    {
        $pregunta = $this->preguntaRepository->find($id);

        if (empty($pregunta)) {
            Flash::error('Pregunta no encontrado');

            return redirect(route('preguntas.index'));
        }

        $this->preguntaRepository->delete($id);

        Flash::success('Pregunta eliminada correctamente');

        return redirect(route('preguntas.index', ['curso_id' => $pregunta->curso_id]));
    }
}
