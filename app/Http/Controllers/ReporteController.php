<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Participante;
use App\Patrones\EstadoEvento;
use App\Patrones\Fachada;
use App\Patrones\Permisos;
use App\Patrones\Rol;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function getSeguimientoMatrizPorFuncion(Request $request, $gestion)
    {
        if(auth()->user()->nivel === Rol::Inicial)
        {
            $empleados = Empleado::with(['funcion', 'funcion.cursoFuncions', 'participantes', 'participantes.evento'])->whereLegajo(auth()->user()->persona->legajo)->get();
        }
        else {
            $txtBuscar = "%";
            if ($request->has('txtBuscar'))
                $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

            if ($request->has('txtFuncion'))
                $txtFuncion = is_null($request->txtFuncion) || $request->txtFuncion === "" ? 0 : $request->txtFuncion;
            else
                $txtFuncion = 1;


            $empleados = Empleado::with(['funcion', 'funcion.cursoFuncions', 'participantes', 'participantes.evento'])
                ->where(function ($q) use ($txtBuscar) {
                    $q->whereRaw("cast(legajo as varchar) = '$txtBuscar'")
                        ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
                        ->orWhere('apellido_paterno', 'ilike', '%' . $txtBuscar . '%')
                        ->orWhere('apellido_materno', 'ilike', '%' . $txtBuscar . '%');
                });

            if($txtFuncion === 0)
                $empleados = $empleados->get();
            else
                $empleados = $empleados->where('funcion_id', $txtFuncion)->get();

        }

        $cursos = Curso::whereEstado(true)->get();
        return view('reportes.seguimiento_matriz_funcion', compact('empleados', 'cursos', 'gestion'));
    }

    public function getProximoVencerse(Request $request, $gestion)
    {
        if(auth()->user()->nivel === Rol::Inicial)
        {
            $empleados = Empleado::whereLegajo(auth()->user()->persona->legajo)->get();
        }
        else {
            $txtBuscar = "%";
            if ($request->has('txtBuscar'))
                $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

            if ($request->has('txtFuncion'))
                $txtFuncion = is_null($request->txtFuncion) || $request->txtFuncion === "" ? 0 : $request->txtFuncion;
            else
                $txtFuncion = 1;

            $empleados = Empleado::with(['funcion'])
                ->where(function ($q) use ($txtBuscar) {
                    $q->whereRaw("cast(legajo as varchar) = '$txtBuscar'")
                        ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
                        ->orWhere('apellido_paterno', 'ilike', '%' . $txtBuscar . '%')
                        ->orWhere('apellido_materno', 'ilike', '%' . $txtBuscar . '%');
                });

            if($txtFuncion === 0)
                $empleados = $empleados->get();
            else
                $empleados = $empleados->where('funcion_id', $txtFuncion)->get();
        }

        $cursos = Curso::whereEstado(true)->get();

        return view('reportes.proximos_a_vencerce', compact('empleados', 'cursos', 'gestion'));
    }

    public function getHistoricoCapacitacion(Request $request)
    {
        $empleado_id = 1;
        if ($request->has('empleado_id'))
            $empleado_id = $request->empleado_id;

        $empleado = Empleado::findOrFail($empleado_id);

        $participantes = Participante::with(['evento'])->
        whereHas('evento', function ($q) {
            $q->whereEstado(EstadoEvento::Finalizado);
        })->whereEmpleadoId($empleado->id)->orderBy('id')->get();

        return view('reportes.historico_capacitacion', compact('empleado', 'participantes'));
    }

    public function getProgramaCapacitacion(Request $request, $gestion)
    {
        $eventos = Evento::whereYear('fecha_final', $gestion)
            ->where('estado', 'like', "%{$request->txtEstado}%")
            ->orderBy('fecha_inicial', 'asc')->get();
        return view('reportes.programa_capacitacion', compact('eventos', 'gestion'));
    }

    public function getResumenEvento($evento_id)
    {
        $evento = Evento::findOrFail($evento_id);
        return view('reportes.resumen_evento', compact('evento'));
    }

    public function getInasistentesCurso(Request $request)
    {
        $fechaInicial = $request->has('fecha_inicial') ? Fachada::setDate($request->fecha_inicial) : Fachada::setDate(date('Y') . '-01-01');
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDate($request->fecha_final) : Fachada::setDate(date('Y') . '-12-31');

        $eventos = Evento::where('fecha_inicial', '>=', $fechaInicial)->where('fecha_final', '<=', $fechaFinal)->get();

        return view('reportes.inasistencia_curso', compact('eventos', 'fechaInicial', 'fechaFinal'));
    }

    public function getPersonalWellControl(Request $request)
    {
        $fechaInicial = $request->has('fecha_inicial') ? Fachada::setDate($request->fecha_inicial) : Fachada::setDate(date('Y') . '-01-01');
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDate($request->fecha_final) : Fachada::setDate(date('Y') . '-12-31');

        //38 id de wellcontrol
        $participantes = Participante::whereHas('evento', function ($q) use ($fechaInicial, $fechaFinal) {
            $q->whereCursoId(38)->where('fecha_final', '>=', $fechaInicial)->where('fecha_final', '<=', $fechaFinal);
        })->get();

        return view('reportes.personalWellControl', compact('participantes', 'fechaInicial', 'fechaFinal'));
    }

    public function getConductoresHabilitados(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

        $txtFuncion = "%";
        if ($request->has('txtFuncion'))
            $txtFuncion = is_null($request->txtFuncion) || $request->txtFuncion === "" ? "%" : $request->txtFuncion;


        //7,10,11 id de cursos
        $empleados = Empleado::whereHas('funcion.cursoFuncions', function ($q) {
            $q->whereIn('curso_id', [20, 40, 17]);
        })->where('funcion_id', 'like', $txtFuncion)
            ->where(function ($q) use ($txtBuscar) {
                $q->whereRaw("cast(legajo as varchar) = '$txtBuscar'")
                    ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
                    ->orWhere('apellido_paterno', 'ilike', '%' . $txtBuscar . '%')
                    ->orWhere('apellido_materno', 'ilike', '%' . $txtBuscar . '%');
            })->get();

        return view('reportes.conductoresHabilitados', compact('empleados'));
    }

    public function getAvanceCursos()
    {
        $cursos = Curso::whereEstado(true)->get();
        return view('reportes.estadistico_capacitacion', compact('cursos'));
    }

    public function getCumplimientoCapacitacion()
    {
        $cursos = Curso::whereEstado(true)->get();
        return view('reportes.estadistico_cumplimiento_capacitacion', compact('cursos'));
    }
}
