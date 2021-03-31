<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use App\Patrones\Fachada;
use Illuminate\Http\Request;

class EventoEstudianteController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicial = $request->has('fecha_inicial') ? Fachada::setDate($request->fecha_inicial) : Fachada::setDate(date('Y') . '-01-01');
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDate($request->fecha_final) : Fachada::setDate(date('Y') . '-12-31');

        $eventos = Evento::with(['usuario'])->whereHas('participantes', function ($q){
                $q->whereEmpleadoId(auth()->user()->persona->id);
        })->where('fecha_inicial', '>=', $fechaInicial)->where('fecha_final', '<=', $fechaFinal);

        if (!is_null($request->curso_id)) {
            $eventos->whereCursoId($request->curso_id);
        }
        $eventos = $eventos->orderByDesc('id')->paginate();

        return view('area_estudiantes.index', compact('eventos'));
    }
}
