<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiaFrancoRequest;
use App\Http\Requests\UpdateDiaFrancoRequest;
use App\Models\DiaFranco;
use App\Models\Empleado;
use App\Patrones\Fachada;
use App\Repositories\DiaFrancoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Date;
use Response;

class DiaFrancoController extends AppBaseController
{
    /** @var  DiaFrancoRepository */
    private $diaFrancoRepository;

    public function __construct(DiaFrancoRepository $diaFrancoRepo)
    {
        $this->diaFrancoRepository = $diaFrancoRepo;
    }

    public function index(Request $request)
    {
        $diaFrancos = DiaFranco::whereEmpleadoId($request->empleado_id)->orderBy('fecha', 'desc')->get();
        $empleado = Empleado::findOrFail($request->empleado_id);

        return view('dia_francos.index', compact('diaFrancos', 'empleado'));
    }

    public function store(CreateDiaFrancoRequest $request)
    {
        $fecha_inicio = Fachada::setDateTime($request->fecha_inicio);
        $fecha_final = Fachada::setDateTime($request->fecha_final);

        $dias = $fecha_inicio->diff($fecha_final)->days;
        $i = 0;
        while ($i <= $dias) {
            $fecha = date('Y-m-d', strtotime($fecha_inicio->format("Y-m-d") . " + " . $i . " day"));

            if (!$this->verificarRegistrado($fecha, $request->empleado_id)) {
                $this->diaFrancoRepository->create([
                    "fecha" => $fecha,
                    "empleado_id" => $request->empleado_id
                ]);
            }
            $i++;
        }

        Flash::success('Dia Francocreado correctamente.');

        return redirect(route('diaFrancos.index', ["empleado_id" => $request->empleado_id]));
    }

    public function destroy($id)
    {
        $diaFranco = $this->diaFrancoRepository->find($id);
        $this->diaFrancoRepository->delete($id);

        Flash::success('Dia Franco eliminado correctamente.');

        return redirect(route('diaFrancos.index', ["empleado_id" => $diaFranco->empleado_id]));
    }

    private function verificarRegistrado(string $fecha, $empleado_id)
    {
        return DiaFranco::whereFecha($fecha)->whereEmpleadoId($empleado_id)->count() > 0;
    }


    public function getAsignar(Request $request)
    {
        if (isset($request->legajo_inicial) && isset($request->legajo_final))
            $empleados = Empleado::whereBetween('legajo', [$request->legajo_inicial, $request->legajo_final])->orderBy('nombre');
        else
            $empleados = Empleado::whereLegajo(-1);

        if($request->funcion_id !== null)
            $empleados->whereFuncionId($request->funcion_id);

        $empleados = $empleados->get();

        $fechaInicio = $request->has('fecha_inicial') ? Fachada::setDateTime($request->fecha_inicial) : Fachada::getDateServer();
        $fechaFinal = $request->has('fecha_final') ? Fachada::setDateTime($request->fecha_final) :  Fachada::setDateTime(date('d/m/Y', strtotime(date('Y-m-d'). " +5 day")));
        return view('dias_francos_asignar.index', compact('empleados', 'fechaInicio', 'fechaFinal'));
    }

    public function asignarFranco($empleado_id, $fecha)
    {
        if ($this->verificarRegistrado($fecha, $empleado_id)) {
            DiaFranco::whereFecha($fecha)->whereEmpleadoId($empleado_id)->delete();
        }
        else{
            $franco = DiaFranco::create([
                'fecha' => $fecha,
                'empleado_id' => $empleado_id,
            ]);
        }

        return response()->json(['res' => true, 'message' => 'Dia de franco asignado/quitado correctamente!']);
    }
}
