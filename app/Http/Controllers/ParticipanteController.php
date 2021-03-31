<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipanteRequest;
use App\Http\Requests\UpdateParticipanteRequest;
use App\Models\Participante;
use App\Patrones\Permisos;
use App\Repositories\ParticipanteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ParticipanteController extends AppBaseController
{
    /** @var  ParticipanteRepository */
    private $participanteRepository;

    public function __construct(ParticipanteRepository $participanteRepo)
    {
        $this->middleware(Permisos::nivelAvanzado())->only(['store', 'destroy']);
        $this->middleware(Permisos::nivelInicial())->only(['index']);


        $this->participanteRepository = $participanteRepo;
    }

    public function index(Request $request)
    {
        $participantes = $this->participanteRepository->all();

        return view('participantes.index')
            ->with('participantes', $participantes);
    }

    public function store(CreateParticipanteRequest $request)
    {
        $input = $request->all();

        $participante = $this->participanteRepository->create($input);

        Flash::success('Participante agregado correctamente.');

        return redirect(route('eventos.edit', $participante->evento));
    }

    public function destroy($id)
    {
        $participante = $this->participanteRepository->find($id);
        $this->participanteRepository->delete($id);

        Flash::success('Participante eliminado correctamente.');

        return redirect(route('eventos.edit', $participante->evento));
    }

    public function seleccionar($participante_id)
    {
        $participante = Participante::findOrFail($participante_id);
        $participante->es_seleccionado = !$participante->es_seleccionado;
        $participante->save();
        return response()->json(['res' => true]);
    }

    public function registrarNota($id, $nota)
    {
        $participante = Participante::findOrFail($id);
        $participante->examen = $nota;
        $participante->final = $nota;
        $participante->save();
        return response()->json(['res' => true]);
    }
}
