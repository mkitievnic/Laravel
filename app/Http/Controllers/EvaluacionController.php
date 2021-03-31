<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Participante;
use App\Models\Pregunta;
use App\Patrones\EstadoEvento;
use App\Patrones\Fachada;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index($evento_id, Participante $participante)
    {
        $cantMinPregunta = Fachada::$cantPreguntas;

        $evento = Evento::with(['examen'])->whereId($evento_id)
            ->whereEstado(EstadoEvento::EnEjecucion)
            ->whereHas('examen', function ($q) {
                $q->whereEstado(true);
            })->first();

        if (!is_null($evento)) {
            $evento->setHidden(['deleted_at', 'created_at', 'updated_at', 'id', 'curso_id', 'usuario_id']);
            $evento->examen->setHidden(['deleted_at', 'created_at', 'updated_at', 'id', 'evento_id', 'id']);

            //verificando las fechas
            if (Fachada::getDateServer() < Fachada::setDateDate($evento->examen->fecha_inicial) ||
                Fachada::getDateServer() > Fachada::setDateDate($evento->examen->fecha_final)) {
                return response()->json(['Error' => 'Este examen esta fuera de fecha']);
            }

            //verificando si el empleado participante esta en el evento
            $empleado = $participante->empleado;
            $esPaticipante = $evento->participantes()->whereEmpleadoId($empleado->id)->first();
            if (is_null($esPaticipante))
                return response()->json(['Error' => 'Este empleado no esta registrado en este curso']);

            ///preguntas
            $preguntasIds = Pregunta::whereCursoId($evento->curso_id)->whereEstado(true);
            if ($preguntasIds->count() < $cantMinPregunta)
                return response()->json(['Error' => 'Deben haber por los mennos ' . $cantMinPregunta . ' preguntas registras para este examen']);
            else
                $preguntasIds = $preguntasIds->pluck('id')->random($cantMinPregunta)->toArray();

            $preguntas = Pregunta::whereCursoId($evento->curso_id)->whereIn('id', $preguntasIds)->get();

            if (!is_null($preguntas))
                $preguntas->makeHidden(['deleted_at', 'created_at', 'updated_at', 'id', 'curso_id']);

            return view('evaluaciones.index', compact('evento', 'preguntas', 'empleado', 'participante'));
        }

        return response()->json(['Error' => 'No existe el examen o no esta habilitado']);
    }
}
