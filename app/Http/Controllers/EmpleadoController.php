<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleado;
use App\Patrones\Fachada;
use App\Patrones\Rol;
use App\Repositories\EmpleadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmpleadoController extends AppBaseController
{
    private $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepo)
    {
        $this->empleadoRepository = $empleadoRepo;
    }

    public function index(Request $request)
    {
        $txtBuscar = "%";
        if ($request->has('txtBuscar'))
            $txtBuscar = is_null($request->txtBuscar) || $request->txtBuscar === "" ? "%" : $request->txtBuscar;

        $txtFuncion = "%";
        if ($request->has('txtFuncion'))
            $txtFuncion = is_null($request->txtFuncion) || $request->txtFuncion === "" ? "%" : $request->txtFuncion;

        $empleados = Empleado::with(['usuario'])->orderBy('id')
            ->where('funcion_id', 'ilike', $txtFuncion)
            ->where(function ($q) use ($txtBuscar) {
                $q->whereRaw("cast(legajo as varchar) ='$txtBuscar'")
                    ->orWhere('nombre', 'ilike', '%' . $txtBuscar . '%')
                    ->orWhere('apellido_paterno', 'ilike', '%' . $txtBuscar . '%')
                    ->orWhere('apellido_materno', 'ilike', '%' . $txtBuscar . '%');
            })->paginate(15);

        //return $empleados;

        return view('empleados.index')
            ->with('empleados', $empleados);
    }

    public function create()
    {
        return view('empleados.create');
    }

    private function subirArchivo($file, $ci)
    {
        if (is_null($file)) {
            Flash::error('Elija imagenes validas. (*.jpg | *.jpeg | *.png)');
            return redirect(route('users.show'));
        }
        $nombreArchivo = $ci . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('user_photos'), $nombreArchivo);
        return $nombreArchivo;
    }

    public function store(CreateEmpleadoRequest $request)
    {
        \DB::beginTransaction();
        try {
            $input = $request->all();
            $fecha_nacimiento = Fachada::setDateTime($request->fecha_nacimiento);
            $input['fecha_nacimiento'] = date('Y-m-d', strtotime($fecha_nacimiento->format("Y-m-d")));

            if ($this->getEdad($fecha_nacimiento) < 18) {
                Flash::error("No puedes registrar menores de edad");
                return redirect(route('empleados.create'));
            }

            if (isset($input['foto_input']))
                $input['foto'] = $this->subirArchivo($input['foto_input'], $request->ci);
            else
                $input['foto'] = 'foto_base.png';

            $empleado = $this->empleadoRepository->create($input);
            $empleado->usuario()->create([
                "email" => $request->email,
            ]);

            Flash::success('Empleado guardado correctamente.');

            \DB::commit();
            return redirect(route('empleados.index'));
        } catch (\Exception $e) {
            \DB::rollback();
            Flash::error('Ha ocurrido un error, vuelva a intentarlo.   ' . $e->getMessage());
            return redirect(route('instructors.index'));
        } catch (\Throwable $e) {
            \DB::error();
            Flash::success('Ha ocurrido un error, vuelva a intentarlo.    ' . $e->getMessage());
            return redirect(route('instructors.index'));
        }

    }

    public function show(Empleado $empleado)
    {
        $this->authorize('show', $empleado);
        return view('users.show')->with('empleado', $empleado);
    }

    public function edit($id)
    {
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }

        return view('empleados.edit')->with('empleado', $empleado);
    }

    public function getEdad(\DateTime $fecha_nacimiento)
    {
        $edad = $fecha_nacimiento->diff(Fachada::getDateServer());
        return $edad->format("%Y");
    }

    public function update($id, UpdateEmpleadoRequest $request)
    {
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');
            return redirect(route('empleados.index'));
        }

        $input = $request->all();

        $fecha_nacimiento = Fachada::setDateTime($request->fecha_nacimiento);
        $input['fecha_nacimiento'] = date('Y-m-d', strtotime($fecha_nacimiento->format("Y-m-d")));

        if ($this->getEdad($fecha_nacimiento) < 18) {
            Flash::error("No puedes registrar menores de edad");
            return redirect(route('empleados.index'));
        }


        if (isset($input['foto_input']))
            $input['foto'] = $this->subirArchivo($input['foto_input'], $request->ci);

        $empleado = $this->empleadoRepository->update($input, $id);

        Flash::success('Empleado actualizado correctamente...');

        return redirect(route('empleados.index'));
    }

    public function destroy($id)
    {
        $empleado = $this->empleadoRepository->find($id);

        if (empty($empleado)) {
            Flash::error('Empleado no encontrado');

            return redirect(route('empleados.index'));
        }

        $this->empleadoRepository->delete($id);

        Flash::success('Empleado eliminado correctamente.');

        return redirect(route('empleados.index'));
    }
}
