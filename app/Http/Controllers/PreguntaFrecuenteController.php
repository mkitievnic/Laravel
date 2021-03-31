<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePreguntaFrecuenteRequest;
use App\Http\Requests\UpdatePreguntaFrecuenteRequest;
use App\Models\Pregunta;
use App\Models\PreguntaFrecuente;
use App\Models\Sector;
use App\Repositories\PreguntaFrecuenteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PreguntaFrecuenteController extends AppBaseController
{
    /** @var  PreguntaFrecuenteRepository */
    private $preguntaFrecuenteRepository;

    public function __construct(PreguntaFrecuenteRepository $preguntaFrecuenteRepo)
    {
        $this->preguntaFrecuenteRepository = $preguntaFrecuenteRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === ""? "%" : $request->txtBuscar;

        $preguntaFrecuentes = PreguntaFrecuente::where('pregunta', 'ilike', '%' . $txtBuscar . '%')->get();

        return view('pregunta_frecuentes.index')
            ->with('preguntaFrecuentes', $preguntaFrecuentes);
    }

    public function create()
    {
        return view('pregunta_frecuentes.create');
    }


    public function store(CreatePreguntaFrecuenteRequest $request)
    {
        $input = $request->all();

        $preguntaFrecuente = $this->preguntaFrecuenteRepository->create($input);

        Flash::success('Pregunta Frecuente guardado correctamente.');

        return redirect(route('preguntaFrecuentes.index'));
    }


    public function show($id)
    {
        $preguntaFrecuente = $this->preguntaFrecuenteRepository->find($id);

        if (empty($preguntaFrecuente)) {
            return response()->json(['res'=>false,'message'=>'Opcion no encontrada']);
        }

        return response()->json(['res'=>false,'message'=>$preguntaFrecuente]);
    }


    public function edit($id)
    {
        $preguntaFrecuente = $this->preguntaFrecuenteRepository->find($id);

        if (empty($preguntaFrecuente)) {
            Flash::error('Pregunta Frecuente no encontrado');

            return redirect(route('preguntaFrecuentes.index'));
        }

        return view('pregunta_frecuentes.edit')->with('preguntaFrecuente', $preguntaFrecuente);
    }


    public function update($id, UpdatePreguntaFrecuenteRequest $request)
    {
        $preguntaFrecuente = $this->preguntaFrecuenteRepository->find($id);

        if (empty($preguntaFrecuente)) {
            Flash::error('Pregunta Frecuente no encontrado');

            return redirect(route('preguntaFrecuentes.index'));
        }

        $preguntaFrecuente = $this->preguntaFrecuenteRepository->update($request->all(), $id);

        Flash::success('Pregunta Frecuente actualizado correctamente.');

        return redirect(route('preguntaFrecuentes.index'));
    }


    public function destroy($id)
    {
        $preguntaFrecuente = $this->preguntaFrecuenteRepository->find($id);

        if (empty($preguntaFrecuente)) {
            Flash::error('Pregunta Frecuente no encontrado');

            return redirect(route('preguntaFrecuentes.index'));
        }

        $this->preguntaFrecuenteRepository->delete($id);

        Flash::success('Pregunta Frecuente eliminado correctamente.');

        return redirect(route('preguntaFrecuentes.index'));
    }

    public function getRespuesta($pregunta)
    {
        $preguntaFrecuente = PreguntaFrecuente::wherePregunta($pregunta)->first();
        if (empty($preguntaFrecuente)) {
            return redirect(['res' => false, 'message'=>'Nunguna respuesta para esa pregunta']);
        }
        return redirect(['res' => true, 'message'=>$pregunta->respuesta]);
    }
}
