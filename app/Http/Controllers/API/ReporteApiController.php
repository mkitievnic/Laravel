<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Empleado;
use App\Models\Evento;
use App\Models\Participante;
use App\Patrones\EstadoEvento;
use App\Patrones\Fachada;
use App\Patrones\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class ReporteApiController extends Controller
{
    public function getProximoVencerse(Request $request)
    {
        try {
            $gestion = $request->gestion;
            $legajo = $request->legajo;;

            $empleados = Empleado::whereLegajo($legajo)->get();

            $cursos = Curso::whereEstado(true)->get();
            $cursos->makeHidden(['duracion', 'vencimiento', 'contenido', 'estado']);


            $data = [];
            foreach ($empleados as $empleado) {
                $total = 0;
                $aprobados = 0;
                foreach ($cursos as $curso) {
                    $cursoFuncion = $empleado->funcion->cursoFuncions->where('curso_id', $curso->id)->where('gestion', $gestion)->first();
                    if (!is_null($cursoFuncion)) {
                        $total++;

                        $participante = $empleado->participantes()->whereHas('evento', function ($q) use ($curso) {
                            $q->whereCursoId($curso->id);
                        })->first();

                        if (!is_null($participante)) {
                            $data[] = ['curso' => $curso->nombre, 'value' => $participante->aVencer['data']];
                            if ($participante->aVencer['res'] === 1)
                                $aprobados++;
                        } else
                            $data[] = ['curso' => $curso->nombre, 'value' => "<span style='color: red'>M</span>"];
                    }
                }
            }

            return response()->json(['success' => true, 'empleado' => $empleado->legajo . ': ' . $empleado->nombre_completo, 'cursos' => $data, 'gestion' => $gestion]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }


    public function getSeguimientoMatrizPorFuncion(Request $request)
    {
        try {
            $gestion = $request->gestion;
            $legajo = $request->legajo;

            $empleados = Empleado::with(['funcion', 'funcion.cursoFuncions', 'funcion.cursoFuncions.curso', 'participantes', 'participantes.evento'])
                ->where('legajo', $legajo)->get();

            $empleados->makeHidden(['funcion.cursoFuncions.curso.contenido']);

            $cursos = Curso::whereEstado(true)->get();
            $cursos->makeHidden(['duracion', 'vencimiento', 'contenido', 'estado']);

            $data = [];
            foreach ($empleados as $empleado) {
                foreach ($cursos as $curso) {
                    $cursoFuncion = $empleado->funcion->cursoFuncions->where('curso_id', $curso->id)->where('gestion', $gestion)->first();

                    if (!is_null($cursoFuncion)) {
                        $participante = $empleado->participantes()->whereHas('evento', function ($q) use ($curso) {
                            $q->whereCursoId($curso->id);
                        })->first();

                        if (!is_null($participante)) {
                            $data[] = ['curso' => $curso->nombre, 'value' => $participante->seguimiento['data']];
                        } else
                            $data[] = ['curso' => $curso->nombre, 'value' => "<span style='color: red'>Pdte</span>"];

                    }
                }
            }

            return response()->json(['success' => true, 'empleados' => $empleado->legajo . ': ' . $empleado->nombre_completo, 'cursos' => $data, 'gestion' => $gestion]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }


    public function getPersonalWellControl(Request $request)
    {
        try {
            $fechaInicial = Fachada::setDate(date('Y') . '-01-01');
            $fechaFinal = Fachada::setDate(date('Y') . '-12-31');

            $legajo = "%";
            if ($request->has('legajo'))
                $legajo = is_null($request->legajo) || $request->legajo === "" ? "%" : $request->legajo;

            //38 id de wellcontrol
            $participantes = Participante::whereHas('evento', function ($q) use ($fechaInicial, $fechaFinal) {
                $q->whereCursoId(38)->where('fecha_final', '>=', $fechaInicial)->where('fecha_final', '<=', $fechaFinal);
            });

            if ($legajo === "%")
                $participantes = $participantes->get();
            else
                $participantes = $participantes
                    ->whereHas('empleado', function ($q) use ($legajo) {
                        $q->whereRaw("cast(legajo as varchar) = '$legajo'");
                    })->get();

            return response()->json(['success' => true, 'participantes' => $participantes]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }

    public function getConductoresHabilitados(Request $request)
    {
        try {
            $legajo = "%";
            if ($request->has('legajo'))
                $legajo = is_null($request->legajo) || $request->legajo === "" ? "%" : $request->legajo;

            $empleados = Empleado::with(['funcion'])
                ->whereHas('funcion.cursoFuncions', function ($q) {
                    $q->whereIn('curso_id', [20, 40, 17]);
                });

            if ($legajo === "%")
                $empleados = $empleados->get();
            else
                $empleados = $empleados
                    ->where(function ($q) use ($legajo) {
                        $q->whereRaw("cast(legajo as varchar) = '$legajo'");
                    })->get();

            $empleados->makeHidden(['ci', 'expedido', 'fecha_nacimiento', 'email', 'telefono', 'foto', 'proveedor_id']);

            $emple = [];
            foreach ($empleados as $empleado) {
                $emple[] = [
                    'legajo' => $empleado->legajo,
                    'nombre' => $empleado->nombre_completo,
                    'funcion' => $empleado->funcion->nombre,
                    'Manejo defensivo' => $empleado->conductorHabilitado(20),
                    'Montacarga' => $empleado->conductorHabilitado(40),
                    'grua' => $empleado->conductorHabilitado(17)
                ];
            }


            return response()->json(['success' => true, 'empleados' => $emple]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }

    public function getEvento($id)
    {
        try {
            $evento = Evento::with(['curso', 'examen', 'participantes', 'participantes.empleado'])->findOrfail($id);
            return response()->json(['success' => true, 'evento' => $evento]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }

    public function getHistoricoCapacitacion(Request $request)
    {
        try {
            $legajo = 0;
            if ($request->has('legajo'))
                $legajo = $request->legajo;

            $empleado = Empleado::whereLegajo($legajo)->first();
            $empleado->setVisible([
                'id', 'legajo', 'nombre', 'apellido_paterno', 'apellido_materno', 'funcion_id'
            ]);

            $participantes = Participante::with(['evento'])->
            whereHas('evento', function ($q) {
                $q->whereEstado(EstadoEvento::Finalizado);
            })->whereEmpleadoId($empleado->id)->orderBy('id')->get();

            $data = [];
            foreach ($participantes as $row) {
                $data[] = [
                    'inicial' => $row->evento->fecha_inicial,
                    'final' => $row->evento->fecha_final,
                    'curso' => $row->evento->curso->nombre,
                    'aprobado' => $row->observacion,
                    'vencido ' => $row->evento->estaVigente,
                    'instructor' => $row->evento->usuario->persona->nombre_completo
                ];
            }

            return response()->json(['success' => true, 'empleado' => $empleado, 'participantes' => $data]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }

    public function getProgramaCapacitacion(Request $request, $gestion)
    {
        $eventos = Evento::whereYear('fecha_final', $gestion)
            ->where('estado', 'like', "%{$request->txtEstado}%")
            ->orderBy('fecha_inicial', 'asc')->get();

        $data = [];
        foreach ($eventos as $evento) {
            $data[] = [
                'inicia' => $evento->fecha_inicial,
                'termina' => $evento->fecha_final,
                'curso' => $evento->curso->nombre,
                'instructor' => $evento->usuario->persona->nombre_completo,
                'estado ' => $evento->estado,
            ];
        }

        return response()->json(['success' => true, 'eventos' => $data, 'gestion' => $gestion]);
    }

    public function getEventoEnviar($id)
    {
        try {
            $evento = Evento::with(['curso', 'examen', 'participantes', 'participantes.empleado'])->findOrfail($id);
            return response()->json(['success' => true, 'evento' => $evento]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }

    public function login($email, $password)
    {
        try {
            $usuario = User::with(['persona.funcion'])->whereEmail($email)->first();
            if (is_null($usuario)) {
                return response()->json(['success' => false, 'message' => "Usuario no registrado"]);
            }

            $credentials = ['email'=>$email, 'password'=>$password];
            if (\Auth::attempt($credentials))
            {
                return response()->json(['success' => true, 'empleado' => $usuario]);
            }
            else
                return response()->json(['success' => false, 'message' => "Usuario no registrado"]);
        } catch (\Exception $e) {
            return $this->make_exception($e);
        }
    }
}
